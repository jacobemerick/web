<?php

abstract class Cookie
{

	protected $is_loaded = false;

	private $exists;
	private $class_name;
	private $value;

	public function __construct($class_name)
	{
		$this->class_new = $class_name;
	}

	abstract protected function getName();
	abstract protected function getDuration();
	abstract protected function getDomain();
	abstract protected function getPath();

	public function setValue($value)
	{
		if(!$this->is_loaded)
			$this->load();
		
		$this->value = $value;
		return $this;
	}

	public function getValue()
	{
		if(!$this->is_loaded)
			$this->load();
		return $this->value;
	}

	public function getExpiration()
	{
		return time() + $this->getDuration();
	}

	public function exists()
	{
		if(!$this->is_loaded)
			$this->load();
		return $this->exists;
	}

	private final function load()
	{
		$name = $this->getName();
		if(isset($_COOKIE[$name]))
			$value = $_COOKIE[$name];
		
		if(isset($value))
		{
			$this->value = $value;
			$this->exists = true;
		}
		else
			$this->exists = false;
		
		$this->is_loaded = true;
	}

	public final function save()
	{
		if(!$this->check_values())
		{
			return false;
		}
		
		if(!$this->set_cookie())
		{
			return false;
		}
		
		return true;
	}

	private final function check_values()
	{
		$name = $this->getName();
		if(empty($name) || strlen($name) < 1)
			return false;
		
		$value = $this->getValue();
		if(!isset($value) || strlen($value) < 1)
			return false;
		
		$expiration = $this->getExpiration();
		if(!isset($expiration) || !is_int($expiration))
			return false;
		
		$domain = $this->getDomain();
		if(!isset($domain) || strlen($domain) < 1)
			return false;
		
		$path = $this->getPath();
		if(!isset($path) || strlen($path) < 1)
			return false;
		
		return true;
	}

	private final function set_cookie()
	{
		$set_cookie = setcookie(
			$this->getName(),
			$this->getValue(),
			$this->getExpiration(),
			$this->getPath(),
			$this->getDomain());
		
		return $set_cookie;
	}

	public static function instance($class_name)
	{
		return Loader::loadNew('utility', "cookie/{$class_name}Cookie", (array) $class_name);
	}

}

?>
