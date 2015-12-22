<?php

Loader::load('controller', '/RobotController');

class ScriptsRobotController extends RobotController
{

	protected function set_data()
	{
		$this->hide_sitemap();
		$this->disallow_for_all_robots();
	}

}

?>