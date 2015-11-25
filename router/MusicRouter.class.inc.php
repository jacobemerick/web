<?php

Loader::load('router', 'Router');

class MusicRouter extends Router
{

	protected function get_redirect_array()
	{
		return array(
			(object) array(
				'pattern' => '@/index.(html|htm|php)$@',
				'replace' => '/'),
			(object) array(
                'pattern' => '@/.*@',
                'replace' => 'http://home.jacobemerick.com/'));
	}

	protected function get_direct_array()
	{
		return array(
			(object) array(
				'match' => '/',
				'controller' => 'HomeController'));
	}

}

?>