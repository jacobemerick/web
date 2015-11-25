<?

final class CronController
{

	private static $CRON_ARRAY = array(
		'BlogCron' => '*/15 * * * *',
		'BookCron' => '*/30 * * * *',
		// 'ChangelogCron' => '0 * * * *',
		'DistanceCron' => '*/15 * * * *',
		'ErrorCron' => '45 23 * * * *',
		// 'PopularMusicCron' => '0 4 * * * *',
		'TwitterCron' => '*/15 * * * *',
		// 'YouTubeCron' => '*/15 * * * *',
		'StreamCron' => '*/15 * * * *');

	private $timestamp;

	public function __construct()
	{
		$this->timestamp = mktime(date('G'), date('i'), 0);
	}

	public function activate()
	{
		foreach(self::$CRON_ARRAY as $cron => $frequency)
		{
			//if(!$this->time_to_run($frequency))
			//	continue;
            if ($cron != 'TwitterCron') continue;
			
			Loader::load('utility', "cron/{$cron}");
			$reflection = new ReflectionClass($cron);
			$object = $reflection->newInstance();
			$reflection_method = new ReflectionMethod($cron, 'activate');
			$result = $reflection_method->invoke($object);
		}
	}

	private function time_to_run($frequency)
	{
		$cur = array();
		$cur['minute'] = date('i', $this->timestamp);
		$cur['hour'] = date('G', $this->timestamp);
		$cur['day'] = date('j', $this->timestamp);
		$cur['month'] = date('n', $this->timestamp);
		$cur['weekday'] = date('w', $this->timestamp);
		
		$time = array();
		$operator = explode(' ', $frequency);
		list($time['minute'], $time['hour'], $time['day'], $time['month'], $time['weekday']) = $operator;
		
		foreach($time as $key => $value)
		{
			if($value == '*')
				continue;
			if(stristr($value, '/'))
			{
				$value = substr($value, 2);
				if($cur[$key] % $value == 0)
					continue;
				else
					return;
			}
			if($cur[$key] == $value)
				continue;
			return;
		}
		return true;
	}

}
