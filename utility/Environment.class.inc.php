<?php

Loader::load('utility', 'Request');

abstract class Environment
{

	protected $user_agent;

	public function __construct($user_agent = null)
	{
		if(!isset($user_agent))
			$user_agent = Request::getServer('HTTP_USER_AGENT');
		$this->user_agent = $user_agent;
	}

	abstract public function getName();

}

?>