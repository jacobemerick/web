<?

Loader::load('collector', 'stream/DistanceCollector');
Loader::load('utility', 'cron/Cron');

final class DistanceCron extends Cron
{

	private static $QUERY = "INSERT INTO `jpemeric_stream`.`distance` (`type`,`distance`,`url`,`felt`,`title`,`message`,`date`) VALUES ('%s','%.2f','%s','%s','%s','%s','%s')";
	private static $JSON_PATH = 'http://api.dailymile.com/people/JacobE4/entries.json';

	private $json;

	function __construct()
	{
		$json = file_get_contents(self::$JSON_PATH);
		$json = json_decode($json);
		$this->json = $json;
	}

	public function activate()
	{
		if(!$this->json)
			return $this->error('Could not connect to feed.');
		
		$count = 0;
		foreach($this->json->entries as $entry)
		{
			$type = $entry->workout->activity_type;
			$type = strtolower($type);
			$type = Database::escape($type);
			
			$distance = $entry->workout->distance->value;
			$distance = round($distance, 2);
			$distance = Database::escape($distance);
			
			$url = Database::escape($entry->url);
			$felt = Database::escape($entry->workout->felt);
			$title = (isset($entry->workout->title)) ? Database::escape($entry->workout->title) : '';
			$message = (isset($entry->message)) ? Database::escape($entry->message) : '';
			$date = date('Y-m-d H:i:s', strtotime($entry->at));
			
			$distance_result = DistanceCollector::getDistanceByFields($date, $type, $distance);
			if($distance_result !== null)
				continue;
			
			$query = sprintf(self::$QUERY, $type, $distance, $url, $felt, $title, $message, $date);
			Database::execute($query);
		}
		return true;
	}

}