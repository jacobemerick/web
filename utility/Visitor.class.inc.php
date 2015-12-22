<?

final class Visitor
{

	private static $tracking_field_array = array(
		'filename' => 'SCRIPT_FILENAME',
		'method' => 'REQUEST_METHOD',
		'domain' => 'HTTP_HOST',
		'uri' => 'REQUEST_URI',
		'referer' => 'HTTP_REFERER',
		'ip' => 'REMOTE_ADDR',
		'user_agent' => 'HTTP_USER_AGENT',
		'code' => 'REDIRECT_STATUS',
		'port' => 'REMOTE_PORT',
		'cookie' => 'HTTP_COOKIE',
		'query' => 'QUERY_STRING');

	private static $instance;

	private function __construct()
	{
		$this->track_visit();
		return $this;
	}

	public static function instance()
	{
		if(!isset(self::$instance))
			self::$instance = new Visitor();
		return self::$instance;
	}

	private $browser;
	public static function getBrowser()
	{
		Loader::load('utility', 'environment/BrowserEnvironment');
		if(!isset(self::instance()->browser))
			self::instance()->browser = new BrowserEnvironment();
		return self::instance()->browser;
	}

	private $platform;
	public static function getPlatform()
	{
		Loader::load('utility', 'environment/PlatformEnvironment');
		if(!isset(self::instance()->platform))
			self::instance()->platform = new PlatformEnvironment();
		return self::instance()->platform;
	}

	private $ip_address;
	public static function getIP()
	{
		Loader::load('utility', 'Request');
		if(!isset(self::instance()->ip_address))
			self::instance()->ip_address = Request::getServer('REMOTE_ADDR');
		return self::instance()->ip_address;
	}

	public static function update301Error()
	{
		return self::instance()->track_response_error(301);
	}

	public static function update303Error()
	{
		return self::instance()->track_response_error(303);
	}

	public static function update404Error()
	{
		return self::instance()->track_response_error(404);
	}

	private $raw_visit_log_id;
	private function track_visit()
	{
		Loader::loadInstance('utility', 'Database');
		
		$query = $this->get_tracking_query();
		if(Database::execute($query) == true)
		{
			$this->raw_visit_log_id = Database::lastInsertID();
			return true;
		}
		return false;
	}

	private function get_tracking_query()
	{
		Loader::load('utility', 'Request');
		$query = "INSERT INTO `jpemeric_log`.`request_raw` (%s) VALUES (%s)";
		
		$columns = '`';
		$values = "'";
		foreach(self::$tracking_field_array as $field_column => $server_array_key)
		{
			$value = Request::getServer($server_array_key);
			$value = Database::escape($value);
			
			$columns .= "{$field_column}`,`";
			$values .= "{$value}','";
		}
		
		if(Request::hasPost())
		{
			$value = Request::getPost();
			$value = serialize($value);
			$value = Database::escape($value);
			
			$columns .= 'post`,`';
			$values .= "{$value}', '";
		}
		
		$columns .= 'date`';
		$values .= date('Y-m-d H:i:s') . "'";
		
		return sprintf($query, $columns, $values);
	}

	private function track_response_error($code)
	{
		if(isset($this->raw_visit_log_id) && $this->raw_visit_log_id > 0)
		{
			$query = "UPDATE `jpemeric_stat`.`raw_visit_log` SET `code` = '{$code}' WHERE `id` = '{$this->raw_visit_log_id}' LIMIT 1";
			return Database::execute($query);
		}
		trigger_error("Tried to update tracking log for a {$code} error, but no log was created!");
		return false;
	}

}
