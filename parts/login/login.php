<?php

namespace carexperiment\parts\login;

require_once __DIR__ . '/../common/autoloader.php';
require_once __DIR__ . '/../common/RedirectMapper.php';
require_once __DIR__ . '/../ext/twig/lib/Twig/Autoloader.php';
require_once __DIR__ . '/ctrl/TrialManager.php';

use carexperiment\parts\login\controller\TrialManager as TrialManager;
use carexperiment\parts\common\RedirectMapper as RedirectMapper;

session_start();

unset($_SESSION['trial_start']);

$error_txt = '';

/*
 * Get difference from now to start and end.
 */
$diff = TrialManager::getNextTrialTime();

/*
 * If the nearest start is in the future. Redirect to the wait page
 */
if( $diff->start > 0 )
{
    $_SESSION['trial_start'] = $diff->start;
    $rmap = new RedirectMapper();
    \header('Location: ' . $rmap->getDestination('wait'));    
    exit();
}

/*
 * If the end difference is negative. There is no trial to do atm
 */
if( $diff->end < 0 )
{
    echo "There are no pending trials.";
    exit();
}

/*
 * Otherwise, display the login page.
 */
if (isset($_SESSION['login_err'])) {
    if (!empty($_SESSION['login_err'])) {
        $error_txt = $_SESSION['login_err'];
        unset($_SESSION['login_err']);
    }
}

//See if the $_GET['src'] is set. If so, pass it to log in controller for redirect.
unset($_SESSION['dest']);

if (isset($_GET['src']) && !empty($_GET['src'])) {
    $_SESSION['dest'] = $_GET['src'];
}

$page_cont = array("login_err"=>$error_txt);
$template_name = 'logintemplate.html.twig';

\Twig_Autoloader::register();

$loader = new \Twig_Loader_Filesystem(__DIR__ . '/view/templates');
$twig_env = new \Twig_Environment($loader);
$tmpl = $twig_env->loadTemplate($template_name);
echo $tmpl->render($page_cont);


