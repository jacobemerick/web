<?php

Loader::load('utility', 'Request');

class Validate
{

	private static $NAME_REGEX = '@[a-z\s\'-]+@i';
	private static $EMAIL_REGEX = '@(?:[a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")\@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])@i';
	private static $URL_REGEX = '@((https?|ftp)\:\/\/)?([a-z0-9-.]*)\.([a-z]{2,3})(\/([a-z0-9+\$_-]\.?)+)*\/?(\?[a-z+&\$_.-][a-z0-9;:\@&%=+\/\$_.-]*)?(#[a-z_.-][a-z0-9+\$_.-]*)?@i';

	public static function isBoolean($value, $strict = false)
	{
		if($strict && ($value === true || $value === false))
			return true;
		if(!$strict && ((bool) $value === true || (bool) $value === false))
			return true;
		return false;
	}

	public static function isDate($value)
	{
		if(strtotime($value) !== -1)
			return true;
		if(date('y', $value) !== false)
			return true;
		return false;
	}

	public static function isInteger($value, $strict = false)
	{
		if($strict)
			return is_int($value);
		return (int) $value == $value;
	}

	public static function isIP($value)
	{
		if(self::isInteger(ip2long($value)))
			return true;
		return false;
	}

	public static function isString($value, $strict = false)
	{
		if($strict)
			return is_string($value);
		return (string) $value == $value;
	}

	public static function isURL($value)
	{
		return true;
		return self::check_value(self::$URL_REGEX, $value);
	}

	public static function isName($value)
	{
		return self::check_value(self::$NAME_REGEX, $value);
	}

	public static function isEmail($value)
	{
		return self::check_value(self::$EMAIL_REGEX, $value);
	}

	private static function check_value($pattern, $string)
	{
		preg_match($pattern, $string, $matches);
		if(empty($matches))
			return false;
		return $matches[0] == $string;
	}

	public static function checkRequest($type, $key, $validation, $strict = false)
	{
		switch($type)
		{
			case 'server':
				$value = Request::getServer($key);
			break;
			case 'post':
				$value = Request::getPost($key);
			break;
		}
		
		if($value == false)
			return false;
		
		switch($validation)
		{
			case 'boolean':
				return self::isBoolean($value, $strict);
			case 'date':
				return self::isDate($value);
			case 'integer':
				return self::isInteger($value, $strict);
			case 'ip':
				return self::isIP($value);
			case 'string':
				return self::isString($value, $strict);
			case 'url':
				return self::isURL($value, $strict);
			case 'name':
				return self::isName($value, $strict);
			case 'email':
				return self::isEmail($value, $strict);
		}
		
		return false;
	}

}

?>