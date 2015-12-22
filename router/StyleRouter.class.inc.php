<?php

Loader::load('router', 'Router');

class StyleRouter extends Router
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
				'match' => '/style/([a-z0-9-]+).css',
				'controller' => 'HomeController'));
	}

}

?>