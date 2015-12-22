<?php

Loader::load('router', 'Router');

class RobotRouter extends Router
{

	protected function get_redirect_array()
	{
		return array(
			(object) array(
				'pattern' => '@^/$@',
				'replace' => 'http://home.jacobemerick.com/'));
	}

	protected function get_direct_array()
	{
		$site = URLDecode::getSite();
		$site = ucwords($site);
		
		return array(
			(object) array(
				'match' => '/robots.txt',
				'controller' => "{$site}RobotController"));
	}

}

?>