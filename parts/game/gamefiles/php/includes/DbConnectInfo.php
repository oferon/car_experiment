<?php
class DbConnectInfo {

    private $username = "root";
    private $password = "root";//"U311_mysql";
    private $server = "127.0.0.1";//"localhost";
    private $port = "8889";//"3306";
    private $databasename = "U311";
    // Hold an instance of the class
    private static $instance;

    //A private constructor prevents objects creatation. Singleton
    private function __construct()
    {

    }

    public static function getDBConnectInfoObject()
    {
		if (!isset(self::$instance)) {
		       $c = __CLASS__;
		        self::$instance = new $c;
		}

        return self::$instance;

    }


    // Prevent users to clone the instance
	public function __clone()
	{
	     trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

	public function getUserName()
	{
		return $this->username;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getServer()
	{
		return $this->server;
	}

	public function getPort()
	{
		return $this->port;
	}

	public function getDatabaseName()
	{
		return $this->databasename;
	}





}


