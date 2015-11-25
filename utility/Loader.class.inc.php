<?

final class Loader
{

	private $root;
	private $is_live;
	private $included_files = array();

	private static $instance;

	private function __construct()
	{
		$this->is_live = !get_cfg_var('development_mode');
		return $this;
	}

	public static function instance()
	{
		if(!isset(self::$instance))
			self::$instance = new Loader();
		return self::$instance;
	}

	private function get_root()
	{
		if(!isset($this->root))
		{
			$current_directory = dirname(__FILE__);
			$current_directory = substr($current_directory, 0, -7);
			$this->root = $current_directory;
		}
		
		return $this->root;
	}

	private function get_delimiter()
	{
		return ($this->is_live) ? '/' : '\\';
	}

	private function check_delimiters($path)
	{
		return ($this->is_live) ? $path : str_replace('/', '\\', $path);
	}

	private static function get_class_name($path)
	{
		$path_array = explode('/', $path);
		return array_pop($path_array);
	}

	private static function get_extension($type)
	{
		switch($type)
		{
			case 'collector' :
			case 'controller' :
			case 'model' :
			case 'module' :
			case 'router' :
			case 'utility' :
				$extension = '.class.inc.php';
			break;
			case 'view' :
				$extension = '.tpl.php';
			break;
		}
		return $extension;
	}

	public static function getImagePath($type, $file)
	{
		if($type == 'photo')
			$type = 'photo/processed';
		
		$path = self::instance()->get_root();
		$path .= 'images';
		$path .= self::instance()->get_delimiter();
		$path .= $type;
		$path .= self::instance()->get_delimiter();
		$path .= self::instance()->check_delimiters($file);
		
		return $path;
	}

	private static function get_path($type, $file)
	{
		$path = self::instance()->get_root();
		$path .= $type;
		$path .= self::instance()->get_delimiter();
		$path .= self::instance()->check_delimiters($file);
		$path .= self::get_extension($type);
		
		return $path;
	}

	private function get_included_files()
	{
		return $this->included_files;
	}

	private function add_included_file($path)
	{
		$this->included_files[] = $path;
	}

	public static function load($type, $files, $data = array())
	{
		foreach((array) $files as $file)
		{
			$file_path = self::instance()->get_path($type, $file);
			if(in_array($file_path, self::instance()->get_included_files()) && $type !== 'view')
				continue;
			
			if(!file_exists($file_path))
				Debugger::logMessage("Requested file does not exist: {$type}, {$file}");
			
			self::instance()->add_included_file($file_path);
			
			switch($type)
			{
				case 'images' :
				case 'scripts' :
				case 'styles' :
					echo file_get_contents($file_path);
				break;
				case 'view' :
					extract($data);
					include($file_path);
				break;
				default :
					include_once($file_path);
				break;
			}
		}
	}

	private static function create_reflection_class($file)
	{
		$class_name = self::instance()->get_class_name($file);
		return new ReflectionClass($class_name);
	}

	public static function loadInstance($type, $file)
	{
		self::load($type, $file);
		
		$reflectionObject = self::create_reflection_class($file);
		
		if(
			$reflectionObject->hasMethod('instance') &&
			$reflectionObject->getMethod('instance')->isStatic())
		{
			return $reflectionObject->getMethod('instance')->invoke(null);
		}
		trigger_error("Requested class cannot be instance'd: {$type}, {$file}");
	}

	public static function loadNew($type, $file, $data = array())
	{
		self::load($type, $file);
		
		$reflectionObject = self::create_reflection_class($file);
		
		if($reflectionObject->hasMethod('__construct'))
			return $reflectionObject->newInstanceArgs($data);
		else
			return $reflectionObject->newInstance();
	}

	public static function getRoot()
	{
		return self::instance()->get_root();
	}

	public static function isLive()
	{
		return self::instance()->is_live;
	}

    public static function getRootURL($site = '')
    {
        if (strlen($site) > 0) {
            if ($site == 'waterfalls' && self::instance()->is_live) {
                return 'http://www.waterfallsofthekeweenaw.com/';
            } else {
                return 'http://' . (self::instance()->is_live ? '' : 'dev.') . $site . '.jacobemerick.com/';
            }
        }
        return '/';
    }

}