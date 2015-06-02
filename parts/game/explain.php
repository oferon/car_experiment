<?php

require_once __DIR__ . '/../common/autoloader.php';
require_once __DIR__ . '/../ext/twig/lib/Twig/Autoloader.php';

use carexperiment\parts\common\RedirectMapper as RedirectMapper;

session_start();

$mapper = new RedirectMapper();

if (!isset($_SESSION['user_id'])) {
    $url = $mapper->getDestination('login');
    header('Location: ' . $url . '?src=explain');
    exit();
}

$properties = array('logout_url' => $mapper->getDestination('logout') ,'game_url' => $mapper->getDestination('game'));

$template_name = 'instructions.twig';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig_env = new Twig_Environment($loader);
$tmpl = $twig_env->loadTemplate($template_name);
echo $tmpl->render($properties);