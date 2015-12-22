<?php

Loader::load('router', 'Router');

class LifestreamRouter extends Router
{

	protected function get_redirect_array()
	{
		return array(
			(object) array(
				'pattern' => '@/index.(html|htm|php)$@',
				'replace' => '/'),
			(object) array(
				'pattern' => '@^/1/$@',
				'replace' => '/'),
			(object) array(
				'pattern' => '@/page_([0-9]+)(/?)$@',
				'replace' => '/page/$1/'),
			(object) array(
				'pattern' => '@/tag/([a-z]+)/$@',
				'replace' => '/$1/'),
			(object) array(
				'pattern' => '@/tag/([a-z]+)/page/([0-9]+)/$@',
				'replace' => '/$1/page/$2/'),
			(object) array(
				'pattern' => '@/tag/([a-z-]+)/$@',
				'replace' => '/'),
			(object) array(
				'pattern' => '@/tag/([a-z-]+)/page/([0-9]+)/$@',
				'replace' => '/'));
	}

	protected function get_direct_array()
	{
		return array(
			(object) array(
				'match' => '/',
				'controller' => 'HomeController'),
			(object) array(
				'match' => '/about/',
				'controller' => 'AboutController'),
			(object) array(
				'match' => '/page/([0-9]+)/',
				'controller' => 'HomeController'),
			(object) array(
				'match' => '/([a-z]+)/',
				'controller' => 'TagController'),
			(object) array(
				'match' => '/([a-z]+)/page/([0-9]+)/',
				'controller' => 'TagController'),
			(object) array(
				'match' => '/([a-z]+)/([0-9]+)/',
				'controller' => 'PostController'));
	}

}

?>