<?

final class PhpQuickProfiler
{

	private static $MEMORY_SIZE_ARRAY = array(
		'bytes',
		'kB',
		'MB',
		'GB',
		'TB',
		'PB',
		'EB',
		'ZB',
		'YB');

	private $start_time;
	private $console;
	private $profile = array();

	public function __construct($console)
	{
		$this->start_time = self::getMicrotime();
		$this->console = $console;
	}

	private function get_console_log()
	{
		$log = $this->console->getLog();
		if(!isset($log['debugger_log']))
			return;
		
		foreach($log['debugger_log'] as $key => $log_item)
		{
			switch($log_item['type'])
			{
				case 'log' :
				case 'error' :
					$log['console'][$key]['data'] = print_r($log_item['data'], true);
				break;
				case 'memory' :
					$log['console'][$key]['data'] = $this->get_readable_file_size($log_item['data']);
				break;
				case 'speed' :
					$log['console'][$key]['data'] = $this->get_readable_time($this->get_elapsed_time());
				break;
			}
		}
		
		return $log;
	}

	private function get_file_data()
	{
		$included_files = $this->get_files();
		$file_array = array();
		
		foreach($included_files as $file)
		{
			$file_size = filesize($file);
			$file_array[] = array(
				'name' => $file,
				'size' => $this->get_readable_memory_usage($file_size));
		}
		
		return $file_array;
	}

	private function get_file_summary_data()
	{
		$included_files = $this->get_files();
		
		$file_count = count($included_files);
		$total_file_size = 0;
		$largest_file_size = 0;
		
		foreach($included_files as $file)
		{
			$file_size = filesize($file);
			$total_file_size += $file_size;
			if($file_size > $largest_file_size)
				$largest_file_size = $file_size;
		}
		
		return array(
			'count' => $file_count,
			'size' => $this->get_readable_memory_usage($total_file_size),
			'largest' => $this->get_readable_memory_usage($largest_file_size));
	}

	private function get_files()
	{
		return get_included_files();
	}

	private function get_query_data()
	{
		Loader::loadInstance('utility', 'Database');
		return Database::getQueryLog();
	}

	private function get_query_summary_data()
	{
		Loader::loadInstance('utility', 'Database');
		return Database::getQueryTotals();
	}

	private function get_memory_data()
	{
		$memory_data = array();
		$memory_data['used'] = $this->get_readable_memory_usage(memory_get_peak_usage());
		$memory_data['total'] = ini_get('memory_limit');
		return $memory_data;
	}

	private function get_speed_data()
	{
		$speed_data = array();
		$speed_data['total'] = $this->get_readable_time($this->get_elapsed_time());
		$speed_data['allowed'] = ini_get('max_execution_time');
		return $speed_data;
	}

	public static function getMicrotime()
	{
		$time = microtime();
		$time = explode(' ', $time);
		return $time[1] + $time[0];
	}

	private function get_readable_memory_usage($memory)
	{
		foreach(self::$MEMORY_SIZE_ARRAY as $key => $memory_size)
		{
			if($memory < 1024)
				break;
			if(count(self::$MEMORY_SIZE_ARRAY) != $key + 1)
				$memory /= 1024;
		}
		
		if($memory_size == 'bytes')
			return sprintf('%01d %s', $memory, $memory_size);
		return sprintf('%01.2f %s', $memory, $memory_size);
	}

	private function get_elapsed_time()
	{
		$current = self::getMicrotime();
		$start = $this->start_time;
		$elapsed = $current - $start;
		$elapsed *= 1000;
		return $elapsed;
	}

	private function get_readable_time($time)
	{
		if($time >= 60000)
			return number_format(($time / 60000), 3, '.', '') . ' m';
		else if($time >= 1000 && $time < 60000)
			return number_format(($time / 1000), 3, '.', '') . ' s';
		else
			return number_format($time, 3, '.', '') . ' ms';
	}

	private function collect_profile_array()
	{
		return array(
			'logs' => $this->get_console_log(),
			'queries' => $this->get_query_data(),
			'queryTotals' => $this->get_query_summary_data(),
			'speedTotals' => $this->get_speed_data(),
			'memoryTotals' => $this->get_memory_data(),
			'files' => $this->get_file_data(),
			'fileTotals' => $this->get_file_summary_data());
	}

	public function display()
	{
		Loader::load('utility', 'pqp/Display');
		$profile_array = $this->collect_profile_array();
		displayPqp($profile_array);
	}

}