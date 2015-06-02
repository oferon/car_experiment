<?php
/*
	Class used to log error messages to a file spcified in the const ERROR_FILE
*/

include_once 'SystemConstants.php';


Class Logger {

	/*
		Rember to place files in a directory with correct write permissions.
		On unix this could  be /tmp
	*/

	const LOG_DIRECTORY = 'C:\\weblogs\\';

	const ERROR_FILE = 'CORELABS_ERROR.log';
	const WARNING_FILE = 'CORELABS_WARNING.log';
	const SECURITY_FILE = 'CORELABS_SECURITY.log';
	const DATABASE_FILE = 'CORELABS_DATABASE.log';
	const ACTIVITY_FILE = 'CORELABS_ACTIVITY.log';

	// Hold an instance of the class
    private static $instance;

	private function __construct()
	{

	}

	// Prevent users to clone the instance. Singleton pattern
	public function __clone()
	{
		trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

	// The singleton method
	public static function getLogger()
	{
		if (!isset(self::$instance)) {
			$c = __CLASS__;
			self::$instance = new $c;
		}

		return self::$instance;
    }


	public function log($msg,$error_type)
	{
		/*
			Enable session support if not already enabled.
			This is compatible with most PHP versions.
			Version 5.4 could use session_status() to achieve thesame result
		*/

		if ( ! isset($_SESSION) )
		{
			session_start();
		}

		//Get Logged In User
		if(isset($_SESSION['user_id']))
			$log_user = $_SESSION['user_id'];
		else
			$log_user = "UNK";

		$date = date('d.m.Y h:i:s');

		$log = "DATE:  ".$date."| MSG: ". $msg ." BY USER: " . $log_user ;

		$log_dest = self::ERROR_FILE;

		/*
			Choose different log file and modify log string
			depending on the type of logging requested
		*/

		switch($error_type)
		{
			case DATABASE_LOG_TYPE:
				$log_dest = self::DATABASE_FILE;
				break;
			case WARNING_LOG_TYPE:
				$log_dest = self::WARNING_FILE;
				break;	
			case ACTIVITY_LOG_TYPE:
				$log_dest = self::ACTIVITY_FILE;
				break;
			case SECURITY_LOG_TYPE:
				$log_dest = self::SECURITY_FILE;
				break;	
			case ERROR_LOG_TYPE:
				$log_dest = self::ERROR_FILE;
				break;
			default:
				$log_dest = self::ERROR_FILE;
				break;
		}

		if( isset($_SERVER['REMOTE_ADDR']))
			$log = $log . " | REMOTE IP: ". $_SERVER['REMOTE_ADDR'];

		$log = $log ."\n";

		$log_dest = self::LOG_DIRECTORY . $log_dest;

		error_log($log, 3, $log_dest);
	}

}