<?php

Loader::load('utility', array(
	'Environment',
	'Mail'));

class BrowserEnvironment extends Environment
{

	private static $MATCH_NOT_OPERA				= '/opera|webtv/i';
	private static $MATCH_INTERNET_EXPLORER		= '/msie\s([^;\s]+)/i';
	private static $MATCH_FIREFOX				= 'firefox/';
	private static $MATCH_FIREFOX_VERSION		= '/firefox\/([^\s]+)/i';
	private static $MATCH_GECKO					= 'gecko/';
	private static $MATCH_OPERA					= '/opera(\s|\/)(\d+)/i';
	private static $MATCH_KONQUEROR				= 'konqueror';
	private static $MATCH_CHROME				= 'chrome';
	private static $MATCH_CHROME_VERSION		= '/chrome\/([^\s]+)/i';
	private static $MATCH_IRON					= 'iron';
	private static $MATCH_SAFARI				= 'applewebkit';
	private static $MATCH_SAFARI_VERSION		= '/version\/(\d+)/i';
	private static $MATCH_MOZILLA				= 'mozilla/';

	private static $NAME_INTERNET_EXPLORER		= 'explorer';
	private static $NAME_FIREFOX				= 'firefox';
	private static $NAME_GECKO					= 'gecko';
	private static $NAME_OPERA					= 'opera';
	private static $NAME_KONQUEROR				= 'konqueror';
	private static $NAME_CHROME					= 'chrome';
	private static $NAME_IRON					= 'iron';
	private static $NAME_SAFARI					= 'safari';
	private static $NAME_MOZILLA				= 'mozilla';
	private static $NAME_UNKNOWN				= 'unknown';

	private $name;
	public function getName()
	{
		if(!isset($this->name))
			$this->process();
		return $this->name;
	}

	private $version;
	public function getVersion()
	{
		if(!isset($this->name))
			$this->process();
		return $this->version;
	}

	private function process()
	{
		if(!preg_match(self::$MATCH_NOT_OPERA, $this->user_agent) &&
			preg_match(self::$MATCH_INTERNET_EXPLORER, $this->user_agent, $version))
		{
			$this->name = self::$NAME_INTERNET_EXPLORER;
			$this->version = $version[1];
		}
		else if(stristr($this->user_agent, self::$MATCH_FIREFOX))
		{
			$this->name = self::$NAME_FIREFOX;
			if(preg_match(self::$MATCH_FIREFOX_VERSION, $this->user_agent, $version))
				$this->version = $version[1];
		}
		else if(stristr($this->user_agent, self::$MATCH_GECKO))
		{
			$this->name = self::$NAME_GECKO;
		}
		else if(preg_match(self::$MATCH_OPERA, $this->user_agent, $version))
		{
			$this->name = self::$NAME_OPERA;
			$this->version = $version[2];
		}
		else if(stristr($this->user_agent, self::$MATCH_KONQUEROR))
		{
			$this->name = self::$NAME_KONQUEROR;
		}
		else if(stristr($this->user_agent, self::$MATCH_CHROME))
		{
			$this->name = self::$NAME_CHROME;
			if(preg_match(self::$MATCH_CHROME_VERSION, $this->user_agent, $version))
				$this->version = $version[1];
		}
		else if(stristr($this->user_agent, self::$MATCH_IRON))
		{
			$this->name = self::$NAME_IRON;
		}
		else if(stristr($this->user_agent, self::$MATCH_SAFARI))
		{
			$this->name = self::$NAME_SAFARI;
			if(preg_match(self::$MATCH_SAFARI_VERSION, $this->user_agent, $version))
				$this->version = $version[1];
		}
		else if(stristr($this->user_agent, self::$MATCH_MOZILLA))
		{
			$this->name = self::$NAME_MOZILLA;
		}
		else
		{
			$this->name = self::$NAME_UNKNOWN;
		}
	}

}

?>
