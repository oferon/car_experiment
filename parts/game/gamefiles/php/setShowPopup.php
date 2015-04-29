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


if(isset($_POST['popup']))
{
    $popup=$_POST['popup'];
    $_SESSION['show_popup'] = $popup;
    
}

/*
 * No error, Send reponseo with OK message.
 */
$msg_sender->onResult(null, 'OK');



