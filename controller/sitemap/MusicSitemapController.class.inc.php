<?php

Loader::load('controller', '/SitemapController');

class MusicSitemapController extends SitemapController
{

	protected function set_data()
	{
		$this->addURL('');
	}

}

?>