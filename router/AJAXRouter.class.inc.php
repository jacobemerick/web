<?php

Loader::load('router', 'Router');

class AJAXRouter extends Router
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
				'match' => '/signOut/user.json',
				'controller' => 'SignOutUserController'),
			(object) array(
				'match' => '/signIn/user.json',
				'controller' => 'SignInUserController'),
			(object) array(
				'match' => '/get/portfolioImage.json',
				'controller' => 'GetPortfolioImageController'),
			(object) array(
				'match' => '/submit/comment.json',
				'controller' => 'SubmitCommentController'),
			(object) array(
				'match' => '/get/popularMusic.json',
				'controller' => 'GetPopularMusicController'));
	}

}

?>