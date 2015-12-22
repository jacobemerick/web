<?php

Loader::load('controller', '/RobotController');

class BlogRobotController extends RobotController
{

	protected function set_data()
	{
		$this->allow_for_all_robots();
		$this->disallow_for_all_robots('/search/');
	}

}

?>