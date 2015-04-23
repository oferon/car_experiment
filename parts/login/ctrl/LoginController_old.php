<?php

namespace carexperiment\parts\login\controller;

include_once(__DIR__ . '/../../common/RedirectMapper.php');
include_once('UserController.php');

use \carexperiment\parts\login\controller\UserController as UserController;
use \carexperiment\parts\common\RedirectMapper as RedirectMapper;

define("E_DEST", "http://localhost/carexperiment/parts/login/login.php");

session_start();

unset($_SESSION['login_err']);
unset($_SESSION['user']);
unset($_SESSION['user_id']);
$_SESSION['score']=0;

session_regenerate_id();

$ctrl = new LoginController();

$dest_code = '';

if( isset($_SESSION['dest']) &&!empty($_SESSION['dest']) ){
$ctrl->setDestCode($_SESSION['dest']);
}

$ctrl->runTask();



class LoginController
{

    private $dest_code = 'default';

    public function setDestCode($code) {
        $this->dest_code = $code;
    }

    public function runTask() {

        $username = null;
        $password = null;

        if (isset($_POST["user"])) {
            $username = $_POST["user"];
        }

        if (isset($_POST["pass"])) {
            $password = $_POST["pass"];
        }

        try {

            /* @var $user_ctrl UserController */
            $user_ctrl = UserController::getController();

            $user_info = $user_ctrl->processLogin($username, $password);
            
            if ($user_info == NULL) {
                $this->failure("Login failed");
            }

            $_SESSION['user'] = $user_info->name;
            $_SESSION['user_id'] = $user_info->id;
            

            $this->success();
        } catch (Exception $e) {

            $err_msg = "Operation failed: Error code " . $e->getCode();

            //Code 0 means that this is none-system error.
            //In this case we should be able to display the message text itself.
            if ($e->getCode() == 0) {
                $err_msg = "Operation failed: " . $e->getMessage();
            }

            $this->failure($err_msg);
        }
    }

    private function success() {

        $rmap = new RedirectMapper();

        header('Location: ' . $rmap->getDestination($this->dest_code));
    }

    private function failure($error_txt) {

        $_SESSION['login_err'] = $error_txt;

        $destination_code = empty($this->dest_code) ? '' : '?src=' . $this->dest_code;

        $url = E_DEST . $destination_code;

        header('Location: ' . $url);
    }

}
