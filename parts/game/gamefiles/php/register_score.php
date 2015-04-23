<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include_once __DIR__ . '/includes/JSONMessageSender.php';
include_once __DIR__ . '/ctrl/GameDataCtrl.php';

session_start();

/* @var $msg_sender JSONMessageSender. Sends JSON encdoded text to the client*/
$msg_sender = new JSONMessageSender();
use carexperiment\GameDataCtrl as GameDataCtrl;

/**
 * Expected POST values
 * action=1&state=1
 */

$action = null;
$state = null;
$user_id = null;

if( !isset($_SESSION['user_id'])){
    $msg_sender->onError(null, "User not logged in.");
}

$user_id = $_SESSION['user_id'];

//Check the $_POST['action']
if (isset($_POST['score']) && !empty($_POST['score'])) {
    $score = $_POST['score'];
} else {
    $msg_sender->onError(null, "Action missing");
}


$_SESSION['score']=$score; 

/*
 * No error, Send reponseo with OK message.
 */
$msg_sender->onResult(null, 'OK');



