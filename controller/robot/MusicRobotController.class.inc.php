<?php

Loader::load('controller', '/RobotController');

class MusicRobotController extends RobotController
{

	protected function set_data()
	{
		$this->allow_for_all_robots();
	}

}

?>