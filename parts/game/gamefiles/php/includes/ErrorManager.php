<?php

class ErrorManager
{

	static function handleError($errno, $errstr, $errfile, $errline)
	{

		if (!(error_reporting() & $errno)) {
	        // This error code is not included in error_reporting
	        return;
	    }

	    switch ($errno) {
		    case E_USER_ERROR:
		        echo "&gt;&gt; <b>ERROR - $errstr</b><br />\n";
		        echo "&gt;&gt; Aborting...<br />\n";
		        exit(1);
		        break;

		    case E_USER_WARNING:
		        echo "<b>My WARNING</b> [$errno] $errstr<br />\n";
		        break;

		    case E_USER_NOTICE:
		        echo "<b>My NOTICE</b> [$errno] $errstr<br />\n";
		        break;

		    default:
		        echo "Unknown error type: [$errno] $errstr<br />\n";
		        break;
	    }

	    /* Don't execute PHP internal error handler */
	    return true;

	}


}

?>
