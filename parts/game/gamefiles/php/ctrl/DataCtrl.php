<?php

namespace carexperiment;

//include_once 'Logger.php';

use \Exception as Exception;

class DataCtrl
{

    //Logger
    private $logger;

    // A private constructor; prevents direct creation of object
    public function __construct()
    {
		//$this->logger = Logger::getLogger();
    }

    protected function log($txt,$log_type)
    {
         //$this->logger->log($txt,$log_type);
    }

    /**
     * Utility function to throw an exception if an error occurs
     * while running a mysql command.
     */
    protected function throwDBExceptionOnError($errno, $errmsg) {
        //$this->log($errmsg,ERROR_LOG_TYPE);
        throw new Exception($errmsg, $errno);
    }

    protected function throwCustomExceptionOnError($errno = 0 ,$errmsg) {
        //$this->log($errmsg,ERROR_LOG_TYPE);
        throw new Exception($errmsg,$errno);
    }



}


