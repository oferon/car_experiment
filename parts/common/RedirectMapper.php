<?php
/*
 *	Class used to map redirect client to a webpage
 * 
 *  Changelog
 *  02/21/15 - Added $host and $root variables to allow dynamic link buildnig for redirect URLs        
*/

namespace carexperiment\parts\common;

class RedirectMapper{

	private $targets = array();

	public function __construct()
	{
                /*
                 * $host and $root vairable should be set to correct values in order for redirect to work as expected
                 */
                $host = $_SERVER['HTTP_HOST'];
                $root = 'carexperiment';
		$this->targets['default'] = "http://$host/$root";
		$this->targets['game'] = "http://$host/$root/parts/game/game.php";
                $this->targets['explain'] = "http://$host/$root/parts/game/explain.php";
                $this->targets['login'] = "http://$host/$root/parts/login/login.php";
                $this->targets['logout'] = "http://$host/$root/parts/login/ctrl/LogoutController.php";
                //$this->targets['debrief'] = "http://ofer.hunter.cuny.edu/research/cargame-simulation-debriefing";
                $this->targets['debrief'] = "http://$host/$root/parts/game/debriefing.php";
                $this->targets['survey'] = "http://$host/$root/parts/game/survey.php";
                $this->targets['survey2'] = "http://$host/$root/parts/game/survey2.php";
                $this->targets['survey3'] = "http://$host/$root/parts/game/survey3.php";
                $this->targets['survey4'] = "http://$host/$root/parts/game/survey4.php";
                $this->targets['survey5'] = "http://$host/$root/parts/game/survey5.php";
                $this->targets['survey6'] = "http://$host/$root/parts/game/survey6.php";
                $this->targets['survey7'] = "http://$host/$root/parts/game/survey7.php";
                $this->targets['survey8'] = "http://$host/$root/parts/game/survey8.php";
                $this->targets['survey9'] = "http://$host/$root/parts/game/survey9.php";
                $this->targets['survey_final'] = "http://$host/$root/parts/game/survey_final.php";

	}

	public function getDestination($code)
	{

		if( array_key_exists($code, $this->targets))
			return $this->targets[$code];
		else
			return $this->targets['default'];

	}


}