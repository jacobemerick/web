<?php

class URLDecode
{

	private static $array = array();

	static function init()
	{
		$host = $_SERVER['HTTP_HOST'];
		$uri = $_SERVER['REQUEST_URI'];
		self::form_url_array($host, $uri);
	}

	static private function form_url_array($host, $uri)
	{
		$uri = substr($uri, 1);
		if(strpos($uri, '?'))
			$uri = substr($uri, 0, strpos($uri, '?'));
		$uri_array = explode('/', $uri);
		
		if(!Loader::isLive())
			$host = substr($host, strpos($host, '.') + 1);
		
		self::$array['host'] = $host;
		
		if ($host == 'www.waterfallsofthekeweenaw.com') {
			self::$array['site'] = 'waterfalls';
		} else {
			self::$array['site'] = substr($host, 0, strpos($host, '.'));
		}
		
		self::$array['base'] = 'http://' . (!Loader::isLive() ? 'dev.' : '') . $host . '/';
		self::$array['uri'] = '/' . implode('/', $uri_array);
		
		if(end($uri_array) == '')
			$uri_array = array_slice($uri_array, 0, count($uri_array) - 1);
		self::$array['pieces'] = (array) $uri_array;
	}

	static function getSite()
	{
		return self::$array['site'];
	}

	static function getHost()
	{
		return self::$array['host'];
	}

	static function getBase()
	{
		return self::$array['base'];
	}

	static function getURI()
	{
		return self::$array['uri'];
	}

	static function getExtension()
	{
		$file = self::getPiece(-1);
		if(substr($file, -1) == '/')
			return false;
		return substr($file, strrpos($file, '.') + 1);;
	}

	static function getPiece($piece = null)
	{
		if(!$piece)
			return self::$array['pieces'];
		
		if($piece == -1)
			return end(self::$array['pieces']);
		
		$piece = $piece - 1;
		if(array_key_exists($piece, self::$array['pieces']))
			return self::$array['pieces'][$piece];
		return;
	}

}

URLDecode::init();

?>
