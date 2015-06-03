<?php

include_once __DIR__ . '/includes/JSONMessageSender.php';
include_once __DIR__ . '/ctrl/GameDataCtrl.php';

session_start();

/* @var $msg_sender JSONMessageSender. Sends JSON encdoded text to the client*/
$msg_sender = new JSONMessageSender();
use carexperiment\GameDataCtrl as GameDataCtrl;

$stats = null;

try {
    //Create the datahandler and insert the data
    /* @var $game_data_ctrl GameDataCtrl */
    $game_data_ctrl = new GameDataCtrl();
    /*
     * Call the $game_data_ctrl to save the data passed from the client
     */
    $stats = $game_data_ctrl->getSystemStats();
    
} catch (Exception $e) {

    $err_msg = "Operation failed: Error code " . $e->getMessage();

    /*
     * By convention, code = 0 means that this is non-system error.
     * In this case we can display the message text itself. 
     */
    
    if ($e->getCode() == 0) {
        $err_msg = "Operation failed: " . $e->getMessage();
    }

    $msg_sender->onError(null, $err_msg);
}

/*
 * No error, Send reponseo with OK message.
 */
$msg_sender->onResult($stats, 'OK');

