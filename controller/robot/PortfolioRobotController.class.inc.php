<?php

Loader::load('controller', '/RobotController');

class PortfolioRobotController extends RobotController
{

	protected function set_data()
	{
		$this->allow_for_all_robots();
	}

}

?>