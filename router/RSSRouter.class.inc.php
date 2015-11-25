<?php

Loader::load('router', 'Router');

class RSSRouter extends Router
{

	protected function get_redirect_array()
	{
		return array(
			(object) array(
				'pattern' => '@^/$@',
				'replace' => 'http://home.jacobemerick.com/'),
			(object) array(
				'pattern' => '@^/rss/blog/$@',
				'replace' => '/rss/'));
	}

	protected function get_direct_array()
	{
		return array(
			(object) array(
				'match' => '/rss/',
				'controller' => 'BlogPostRSSController'));
	}

}

?>