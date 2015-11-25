<?php

Loader::load('utility', 'Cookie');

class MusicHidePopupCookie extends Cookie
{

	private static $COOKIE_NAME			= 'hide_popup';
	private static $COOKIE_DURATION		= 1209600; // two weeks
	private static $COOKIE_DOMAIN		= 'music.jacobemerick.com';
	private static $COOKIE_PATH			= '/';

	protected function getName()
	{
		return self::$COOKIE_NAME;
	}

	protected function getDuration()
	{
		return self::$COOKIE_DURATION;
	}

	protected function getDomain()
	{
		return self::$COOKIE_DOMAIN;
	}

	protected function getPath()
	{
		return self::$COOKIE_PATH;
	}

}

?>