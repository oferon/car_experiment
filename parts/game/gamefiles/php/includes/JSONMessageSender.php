<?php
/*
	Class used to send messages to the client
*/
include_once 'MessageSender.php';


class JSONMessageSender extends MessageSender {


	public function sendMessage($response)
	{

		echo json_encode($response);
		exit();

	}


}