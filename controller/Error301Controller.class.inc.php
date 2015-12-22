<?php

Loader::load('controller', '/PageController');

class Error301Controller extends PageController
{

	public function __construct($uri)
	{
		Visitor::update301Error($uri);
		Header::redirect($uri);
		exit;
	}

	protected function set_head_data() {}
	protected function set_body_data() {}

}
