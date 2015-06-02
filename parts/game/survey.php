<?php

require_once __DIR__ . '/../common/autoloader.php';
require_once __DIR__ . '/../ext/twig/lib/Twig/Autoloader.php';

use carexperiment\parts\common\RedirectMapper as RedirectMapper;

session_start();

$mapper = new RedirectMapper();

if (!isset($_SESSION['user_id'])) {
    
    $url = $mapper->getDestination('login');
    header('Location: ' . $url);
    exit();
}

$errors_array = [];

if (isset( $_SESSION['f_errs'])) {
    
    $errors_array = $_SESSION['f_errs'];
    
}

$form_error = '';

if (isset( $_SESSION['form_err'])) {
    
    $form_error = $_SESSION['form_err'];
    
}

$page_cont = array('logout_url' => $mapper->getDestination('logout'), 'errors' => $errors_array,'form_error'=>$form_error);
$template_name = 'survey.twig';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig_env = new Twig_Environment($loader);
$tmpl = $twig_env->loadTemplate($template_name);
echo $tmpl->render($page_cont);