<?php

require_once __DIR__ . '/../common/autoloader.php';
require_once __DIR__ . '/../ext/twig/lib/Twig/Autoloader.php';
use carexperiment\parts\common\RedirectMapper as RedirectMapper;
session_start();


$mapper = new RedirectMapper();
/*
if (!isset($_SESSION['user_id'])) {
    
    $url = $mapper->getDestination('login');
    header('Location: ' . $url);
    exit();
}
*/
$length = 5;

$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
}


$page_cont = array('rand_str' => $randomString);
$template_name = 'debriefing.twig';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig_env = new Twig_Environment($loader);
$tmpl = $twig_env->loadTemplate($template_name);
echo $tmpl->render($page_cont);

session_unset();
session_destroy();