<?php

Loader::load('router', 'Router');

class AJAXRouter extends Router
{

	protected function get_redirect_array()
	{
		return array(
			(object) array(
				'pattern' => '@^/$@',
				'replace' => 'https://home.jacobemerick.com/'));
	}

	protected function get_direct_array()
	{
		return array(
			(object) array(
				'match' => '/get/portfolioImage.json',
				'controller' => 'GetPortfolioImageController'),
    );
	}

}

?>
