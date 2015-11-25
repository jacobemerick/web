<?

Loader::load('collector', 'stream/YouTubeCollector');

Loader::load('utility', 'cron/Cron');

final class YouTubeCron extends Cron
{

	private static $INSERT_NEW_QUERY = "INSERT INTO `jpemeric_stream`.`youtube` (`video_id`,`title`,`content`,`author`,`date_published`,`date`) VALUES ('%s','%s','%s','%s','%s','%s')";

	private static $REQUEST_URL = 'http://gdata.youtube.com/feeds/api/users/jpemeric/favorites';

	private $xml;

	public function __construct()
	{
		$this->xml = simplexml_load_file(self::$REQUEST_URL);
	}

	public function activate()
	{
		if(!$this->xml)
			return $this->error('Could not connect to youtube xml feed.');
		
		$count = 0;
		foreach($this->xml->entry as $entry)
		{
			$video_id = $entry->id;
			$video_id = explode('/', $video_id);
			$video_id = array_pop($video_id);
			
			$video_exists = YouTubeCollector::checkForVideoByVideoID($video_id);
			if($video_exists)
				continue;
			
			$title = Database::escape($entry->title);
			$content = Database::escape($entry->content);
			$author = Database::escape($entry->author->name);
			$date_published = date('Y-m-d H:i:s', strtotime($entry->published));
			$date = date('Y-m-d H:i:s');
			
			$query = sprintf(self::$INSERT_NEW_QUERY, $video_id, $title, $content, $author, $date_published, $date);
			Database::execute($query);
		}
		return true;
	}

}