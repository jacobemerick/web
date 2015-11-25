<?php

Loader::load('router', 'Router');

class ScriptRouter extends Router
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
		return array(
			(object) array(
				'match' => '/script/([a-z0-9-\.]+).js',
				'controller' => 'HomeController'));
	}

}

?>