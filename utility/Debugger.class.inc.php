<?

use ParticleTree\Pqp\Console;
use ParticleTree\Pqp\PhpQuickProfiler;

final class Debugger
{

	private static $UNKNOWN_ERROR_FILE		= 'Unknown File';
	private static $UNKNOWN_ERROR_LINE		= 'Unknown Line';
	private static $UNKNOWN_ERROR_CONTEXT	= 'Unknown Context';

	private $profiler;
	private $display = true;

	private static $instance;

	private function __construct()
	{
		$this->console = new Console();
		$this->profiler = new PhpQuickProfiler($this->console);
	}

	public static function instance()
	{
		if(!isset(self::$instance))
			self::$instance = new Debugger();
		return self::$instance;
	}

	public static function log($message)
	{
		self::instance()->console->logError(new Exception(), 'Gah, this is using Debugger::log()!');
		self::instance()->console->log($message);
	}

	public static function logMessage($message)
	{
		self::instance()->console->log($message);
	}

	public static function logMemory($object = null, $name = '')
	{
		self::instance()->console->logMemory($object, $name);
	}

	public static function logSpeed($message = '')
	{
		self::instance()->console->logSpeed($message);
	}

	public static function internal_error($code, $string, $file = null, $line = null, $context = null)
	{
		if($file == null)
			$file = self::$UNKNOWN_ERROR_FILE;
		if($line == null)
			$line = self::$UNKNOWN_ERROR_LINE;
		if($context == null)
			$context = self::$UNKNOWN_ERROR_CONTEXT;
		
		self::instance()->console->logError(new Exception(), "{$string}... TYPE: {$code}");
		
		return true;
	}

	public static function shutdown()
	{
		$error = error_get_last();
		
		if(isset($error))
			self::internal_error($error['type'], $error['message'], $error['file'], $error['line']);
		
		self::display();
		return true;
	}

	public static function hide()
	{
		self::instance()->display = false;
	}

	public static function display()
	{
		if(!Loader::isLive() && self::instance()->display)
			self::instance()->profiler->display();
	}

}
