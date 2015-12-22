<?php

Loader::load('utility', 'Header');

abstract class RobotController
{

	private static $ALL_ROBOTS = '*';
	private static $ALL_URL = '/';

	private $entries = array();
	private $show_sitemap = true;

	abstract protected function set_data();

	public function __construct()
	{
		Debugger::hide();
	}

	protected function hide_sitemap()
	{
		$this->show_sitemap = false;
	}

	protected function allow_for_all_robots($url = null)
	{
		$entry = new stdclass();
		$entry->agent = self::$ALL_ROBOTS;
		if($url)
			$entry->allow = $url;
		else
		{
			$entry->disallow = '';
			$entry->allow = self::$ALL_URL;
		}
		
		$this->entries[] = $entry;
	}

	protected function disallow_for_all_robots($url = null)
	{
		$entry = new stdclass();
		$entry->agent = self::$ALL_ROBOTS;
		if($url)
			$entry->disallow = $url;
		else
			$entry->disallow = self::$ALL_URL;
		
		$this->entries[] = $entry;
	}

	public function activate()
	{
		$this->set_data();
		Header::sendRobot();
		
		foreach($this->entries as $key => $entry)
		{
			if($key == 0)
				echo "User-agent: {$entry->agent}\n";
			if(isset($entry->disallow) && $entry->disallow != '')
				echo "Disallow: {$entry->disallow}\n";
			if(isset($entry->allow))
				echo "Allow: {$entry->allow}\n";
			//echo "\n";
		}
		
		if($this->show_sitemap)
		{
			echo "\n";
			$sitemap = URLDecode::getBase() . 'sitemap.xml';
			echo "Sitemap: {$sitemap}";
		}
	}

}

?>