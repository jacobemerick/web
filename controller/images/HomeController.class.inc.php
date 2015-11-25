<?php

Loader::load('utility', array(
	'Header',
	'ImageOld'));

class HomeController
{

	public function __construct()
	{
		Debugger::hide();
	}

	public function activate()
	{
		$file = URLDecode::getURI();
		
		if(
			URLDecode::getSite() == 'images' ||
			URLDecode::getExtension() == 'ico')
			$file = "/css/{$file}";
		else if(URLDecode::getSite() == 'portfolio')
			$file = "/portfolio/{$file}";
		else if(substr($file, 0, 7) == '/photo/')
			$file = '/photo/processed/' . substr($file, 7);
		
		$this->use_old_image_logic($file);
		
		return;
	}

	private function send_headers($extension, $last_modified)
	{
		switch($extension)
		{
			case 'gif' :
				Header::sendGIF($last_modified);
			break;
			case 'ico' :
				Header::sendICO($last_modified);
			break;
			case 'jpg' :
				Header::sendJPG($last_modified);
			break;
			case 'png' :
				Header::sendPNG($last_modified);
			break;
		}
	}

	private function use_old_image_logic($file)
	{
		$image = new ImageOld($file);
		if(!$image->isValid()) {
			$this->eject();
		}
		
		switch($image->getExtension())
		{
			case 'gif' :
				Header::sendGIF($image->getLastModified());
			break;
			case 'ico' :
				Header::sendICO($image->getLastModified());
			break;
			case 'jpg' :
				Header::sendJPG($image->getLastModified());
			break;
			case 'png' :
				Header::sendPNG($image->getLastModified());
			break;
		}
		
		$image->load();
		exit;
	}

	protected function eject()
	{
		if(get_class($this) !== 'Error404Controller')
			Loader::loadNew('controller', '/Error404Controller')->activate();
	}

}
