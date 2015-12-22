<?

Loader::load('collector', 'stream/BookCollector');
Loader::load('utility', 'cron/Cron');

final class BookCron extends Cron
{

	private static $QUERY = "INSERT INTO `jpemeric_stream`.`book` (`title`,`author`,`link`,`description`,`image`,`date_read`,`date_added`) VALUES ('%s','%s','%s','%s','%s','%s','%s')";
	private static $XML_PATH = 'http://www.goodreads.com/review/list_rss/4183153';

	private $xml;

	function __construct()
	{
		$xml = simplexml_load_file(self::$XML_PATH, 'SimpleXMLElement', LIBXML_NOCDATA);
		$this->xml = $xml;
	}

	public function activate()
	{
		if(!$this->xml)
			return $this->error('Could not connect to feed.');
		
		foreach($this->xml->channel->item as $item)
		{
			if(strtotime($item->user_read_at) <= 0)
				continue;
			
			$title = $item->title;
			$title = trim($title);
			$title = Database::escape($title);
			
			$author = $item->author_name;
			$author = trim($author);
			$author = Database::escape($author);
			
			$link = Database::escape($item->link);
			$description = Database::escape($item->book_description);
			$image = $item->book_large_image_url;
			$date_read = date('Y-m-d H:i:s', strtotime($item->user_read_at));
			$date_added = date('Y-m-d H:i:s', strtotime($item->user_date_created));
			
			$book_result = BookCollector::getBookByFields($title, $author);
			if($book_result !== null)
				continue;
			
			$query = sprintf(self::$QUERY, $title, $author, $link, $description, $image, $date_read, $date_added);
			Database::execute($query);
		}
		return true;
	}

}