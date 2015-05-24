<?php

require_once __DIR__ . '/../common/autoloader.php';
require_once __DIR__ . '/../ext/twig/lib/Twig/Autoloader.php';

use carexperiment\parts\common\RedirectMapper as RedirectMapper;

session_start();

$mapper = new RedirectMapper();

$page_cont = array('logout_url' => $mapper->getDestination('logout'));
$template_name = 'serverstatevars.js.twig';

Twig_Autoloader::register();

$session_number = 1;
$show_popup = true;
$game_score=0;

if( isset($_SESSION['session_num']) && is_numeric($_SESSION['session_num'])){
    $session_number = $_SESSION['session_num'];
}

if( isset($_SESSION['show_popup']) && is_numeric($_SESSION['show_popup'])){
    $show_popup = $_SESSION['show_popup'];
}

if( isset($_SESSION['score']) && is_numeric($_SESSION['score'])){
    $game_score = $_SESSION['score'];
}


$dest = './survey.php';
switch ($session_number) {
    case 1:
        $dest = './survey.php';

        break;

     case 2:
        $dest = './survey2.php';

        break;

    case 3:
        $dest = './survey3.php';

        break;

    case 4:
        $dest = './survey4.php';
        //$dest = './survey_final.php';

        break;

    case 5:
        $dest = './survey5.php';
        //$dest = './survey_final.php';

        break;

    case 6:
        $dest = './survey6.php';

        break;

    case 7:
        $dest = './survey7.php';

        break;

    case 8:
        $dest = './survey8.php';

        break;

    case 9:
        $dest = './survey9.php';

        break;

    case 10:
        $dest = './survey_final.php';

        break;


    default:
        
        $dest = './survey_final.php';
        break;
}


$session_array = array("session_number"=>$session_number,"survey_url"=>$dest, "game_score"=>$game_score, "show_popup"=>$show_popup);


$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig_env = new Twig_Environment($loader);
$tmpl = $twig_env->loadTemplate($template_name);
header('Content-Type: application/javascript');
echo $tmpl->render($session_array);