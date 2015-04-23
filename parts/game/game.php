<?php

require_once __DIR__ . '/../common/autoloader.php';
require_once __DIR__ . '/../ext/twig/lib/Twig/Autoloader.php';

use carexperiment\parts\common\RedirectMapper as RedirectMapper;

session_start();

$mapper = new RedirectMapper();

if (!isset($_SESSION['user_id'])) {
    
    $url = $mapper->getDestination('login');
    header('Location: ' . $url . '?src=game');
    exit();
}

$session_number = 1;

if( isset($_SESSION['session_num'])){
    $session_number = $_SESSION['session_num'];
}
else {
    $_SESSION['session_num'] = $session_number;
}

$page_cont = array("session_number"=>$session_number);
$template_name = 'game.twig';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig_env = new Twig_Environment($loader);
$tmpl = $twig_env->loadTemplate($template_name);
echo $tmpl->render($page_cont);