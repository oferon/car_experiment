<?php

namespace carexperiment\parts\login;

require_once __DIR__ . '/../common/RedirectMapper.php';
require_once __DIR__ . '/../ext/twig/lib/Twig/Autoloader.php';

session_start();

$wait_time = "Unknow";

if( isset($_SESSION['trial_start']))
{
    $wait_time = $_SESSION['trial_start'];
    
    $dtF = new \DateTime("@0");
    $dtT = new \DateTime("@$wait_time");
    $wait_time_str =  $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
}

$page_cont = array("wait_time"=>$wait_time_str);
$template_name = 'waitfortrial.html.twig';

\Twig_Autoloader::register();

$loader = new \Twig_Loader_Filesystem(__DIR__ . '/view/templates');
$twig_env = new \Twig_Environment($loader);
$tmpl = $twig_env->loadTemplate($template_name);
echo $tmpl->render($page_cont);