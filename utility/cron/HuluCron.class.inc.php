<?

Loader::load('collector', 'data/HuluCollector');
Loader::load('utility', 'Content');
Loader::load('utility', 'cron/Cron');

final class HuluCron extends Cron
{

	private static $QUERY = "INSERT INTO `jpemeric_data`.`hulu` (`date`,`video`,`link`,`action`,`description`,`display`) VALUES ('%s','%s','%s','%d','%s','%d')";
	private static $XML_PATH = 'http://www.hulu.com/feed/history/jpemeric';

	private $xml;

	function __construct()
	{
		$xml = simplexml_load_file(self::$XML_PATH);
		$this->xml = $xml;
	}

	public function activate()
	{
		if(!$this->xml)
			return $this->error('Could not connect to feed.');
		
		$count = 0;
		foreach($this->xml->channel->item as $item)
		{
			$date = date('Y-m-d H:i:s', strtotime($item->pubDate));
			
			if(preg_match_all('/((rated)|(wrote a review about)|(subscribed to)|(watched) )(.+)/', $item->title, $title_array) > 0)
			{
				$video = array_pop($title_array);
				$video = current($video);
				$video = substr($video, 0, -1);
			}
			else if(preg_match_all('/(.*) - (s\d+) | (e\d+) - (.*)/', $item->title, $title_array) > 0)
				$video = "{$title_array[1][0]}: {$title_array[4][1]}";
			else
				$video = $item->title;
			
			$url = $item->link;
			
			if($item->category == 'Vote')
			{
				$description = stristr($video, 'and gave it');
				$description = substr($description, 12);
				$description = trim($description);
				$description = substr($description, 0, 1);
				$text = substr($video, 0, strpos($video, 'and gave it') - 1);
				$video = trim($video);
			}
			else
				$description = '';
			
			switch($item->category)
			{
				case 'ActivityViewedVideo' :
					$action = 1;
				break;
				case 'Vote' :
					$action = 2;
				break;
				case 'Review' :
					$action = 3;
				break;
				case 'ActivitySubscription' :
					$action = 4;
				break;
				default :
					$action = 1;
				break;
			}
			
			$hulu_result = HuluCollector::getHuluByFields($video, $action);
			if($hulu_result !== null)
				continue;
			
			$display = (
				Content::instance('Acceptable', $video)->check() === true &&
				Content::instance('Acceptable', $description)->check() === true) ? 1 : 0;
			
			$video = Database::escape($video);
			$url = Database::escape($url);
			$description = Database::escape($description);
			
			$query = self::$QUERY;
			$query = sprintf($query, $date, $video, $url, $action, $description, $display);
			Database::execute($query);
		}
		return true;
	}

}