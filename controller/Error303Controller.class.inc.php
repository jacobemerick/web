<?php

Loader::load('controller', '/PageController');

class Error303Controller extends PageController
{

	public function __construct($uri)
	{
		Header::redirect($uri, 303);
		exit;
	}

	protected function set_head_data() {}
	protected function set_body_data() {}

}
