<?php

namespace carexperiment\parts\login;

require_once __DIR__ . '/../common/autoloader.php';

session_start();

$is_error = FALSE;
$error_txt = '';


if (isset($_SESSION['login_err'])) {
    if (!empty($_SESSION['login_err'])) {
        $is_error = TRUE;
        $error_txt = $_SESSION['login_err'];

        unset($_SESSION['login_err']);
    }
}

//See if the $_GET['src'] is set. If so, pass it to log in controller for redirect.
unset($_SESSION['dest']);

if (isset($_GET['src']) && !empty($_GET['src'])) {
    $_SESSION['dest'] = $_GET['src'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login page</title>
<link href="./css/login.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="page_element" id="view_port">
            <div>
                <div>
                    <!-- Main container-->
                    <div class="layout_row">
                        <div class="login_wrapper page_sub_element">
                            <div id="login_help_header">Sign in:</div>
                            <form id="login_form" action="ctrl/LoginController.php" method="POST">

                                <?php
                                if ($is_error)
                                    echo '<div class="login_form_element login_form_fld" id="error_msg"><img id="warning_img" src="./imgs/dialog_warning.png"></img> ' . $error_txt . '</div>';
                                ?>

                                <div class="login_form_element login_form_fld" >
                                    <input type="text" id="username_txt" class="login_txt_box" name="user" placeholder="User Name">
                                </div>
                                <div class="login_form_element login_form_fld">
                                    <input type="password" id="password_txt" class="login_txt_box" name="pass" placeholder="Password"></input>
                                </div>
                                <div class="login_form_element login_form_btn">
                                    <input type="submit" id="login_btn" value="Sign in">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Main container-->
                </div>

                <div id="credits">
                    Developed by DF,OT
                </div>
            </div>
	</div>
</body>
</html>
