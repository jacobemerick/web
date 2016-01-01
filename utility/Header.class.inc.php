<?

final class Header
{

	private static $CACHE_EXPIRATION = 315360000;
	private static $CACHE_MODIFICATION = 604800;
	private static $SITEMAP_EXPIRATION = 604800;
	private static $RSS_EXPIRATION = 604800;

	public static function sendJSON()
	{
		$array = array(
			'HTTP/1.1 200 OK',
			'Cache-Control: no-cache',
			'Content-Language: en',
			'Content-Type: application/json',
			'Expires: ' . self::get_date(time() - 1),
			'Last-Modified: ' . self::get_date(),
			'X-Powered-By: jacobemerick.com');
		self::send($array);
	}

	public static function sendSitemap()
	{
		$array = array(
			'HTTP/1.1 200 OK',
			'Cache-Control: max-age=' . self::$SITEMAP_EXPIRATION . ', must-revalidate',
			'Content-Language: en',
			'Content-Type: text/xml',
			'Expires: ' . self::get_date(time() + self::$SITEMAP_EXPIRATION),
			'Last-Modified: ' . self::get_date(),
			'X-Powered-By: jacobemerick.com');
		self::send($array);
	}

	public static function sendHTML()
	{
		$array = array(
			'HTTP/1.1 200 OK',
			'Cache-Control: no-cache',
			'Content-Language: en',
			'Content-Type: text/html',
			'Expires: ' . self::get_date(time() - 1),
			'Last-Modified: ' . self::get_date(),
			'X-Powered-By: jacobemerick.com');
		self::send($array);
	}

	public static function redirect($location, $method = 301)
	{
		header("Location: {$location}", TRUE, $method);
		exit();
	}

	public static function send404()
	{
		$array = array(
			'HTTP/1.1 404 Not Found',
			'Cache-Control: no-cache',
			'Content-Language: en',
			'Content-Type: text/html',
			'Expires: ' . self::get_date(time() - 1),
			'Last-Modified: ' . self::get_date(),
			'X-Powered-By: jacobemerick.com');
		self::send($array);
	}

	public static function send503()
	{
		$array = array(
			'HTTP/1.1 503 Service Unavailable',
			'Cache-Control: no-cache',
			'Content-Language: en',
			'Content-Type: text/html',
			'Expires: ' . self::get_date(time() - 1),
			'Last-Modified: ' . self::get_date(),
			'X-Powered-By: jacobemerick.com');
		self::send($array);
	}

	private static function send($array, $gzip = true)
	{
		if($gzip)
			self::start_gzipping();
		
		foreach($array as $row)
		{
			header($row, TRUE);
		}
	}

	private static function get_date($timestamp = false)
	{
		if($timestamp == 0)
			$timestamp = time();
		return gmdate('D, d M Y H:i:s \G\M\T', $timestamp);
	}

	private static function start_gzipping()
	{
		if(!ob_start('ob_gzhandler'))
            ob_start();
	}

}
