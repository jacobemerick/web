<?

final class Console
{

	private $debugger_log = array();

	private $log_count = 0;
	private $memory_count = 0;
	private $error_count = 0;
	private $speed_count = 0;

	public function log($data)
	{
		$log_item = array(
			'data' => $data,
			'type' => 'log');
		
		$this->add_log($log_item);
		$this->log_count++;
	}

	public function logMemory($object = false, $name = 'PHP')
	{
		$memory = ($object !== false) ? strlen(serialize($object)) : memory_get_usage();
		
		$log_item = array(
			'data' => $memory,
			'type' => 'memory',
			'name' => $name,
			'dataType' => gettype($object));
		
		$this->add_log($log_item);
		$this->memory_count++;
	}

	public function logError($string = '', $file = '', $line = '')
	{
		$log_item = array(
			'data' => $string,
			'type' => 'error',
			'file' => $file,
			'line' => $line);
		
		$this->add_log($log_item);
		$this->error_count++;
	}

	public function logSpeed($name = 'Point in Time')
	{
		$logItem = array(
			'data' => PhpQuickProfiler::getMicroTime(),
			'type' => 'speed',
			'name' => $name);
		
		$this->add_log($log_item);
		$this->speed_count++;
	}

	private function add_log($item)
	{
		$this->debugger_log[] = $item;
	}

	public function getLog()
	{
		return array(
			'debugger_log' => $this->debugger_log,
			'memory_count' => $this->memory_count,
			'log_count' => $this->log_count,
			'speed_count' => $this->speed_count,
			'error_count' => $this->error_count);
	}

}