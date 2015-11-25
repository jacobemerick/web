<?

Loader::load('utility', 'Cookie');

class AdminUserCookie extends Cookie
{

	private static $COOKIE_NAME			= 'admin_user';
	private static $COOKIE_DURATION		= 7200; // two hours
	private static $COOKIE_DOMAIN		= 'admin.jacobemerick.com';
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