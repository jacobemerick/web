<?

Loader::load('utility', 'Cookie');

class CommenterCookie extends Cookie
{

	private static $COOKIE_NAME			= 'commenter';
	private static $COOKIE_DURATION		= 31536000; // one year
	private static $COOKIE_DOMAIN		= 'jacobemerick.com';
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
        $site = URLDecode::getSite();
        if ($site == 'waterfalls' && Loader::isLive()) {
            return 'waterfallsofthekeweenaw.com';
        }
		return self::$COOKIE_DOMAIN;
	}

	protected function getPath()
	{
		return self::$COOKIE_PATH;
	}

}