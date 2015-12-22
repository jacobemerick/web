<?

Loader::load('collector', array(
	'stream/ActivityCollector',
	'stream/BlogCollector',
	'stream/BookCollector',
	'stream/DistanceCollector',
	'stream/TwitterCollector',
	'stream/YouTubeCollector'));

Loader::load('utility', 'cron/Cron');

final class StreamCron extends Cron
{

	private static $QUERY = "INSERT INTO `jpemeric_stream`.`post` (`type`,`type_id`,`date`) VALUES ('%s','%d','%s')";

	public function activate()
	{
		$this->process_blog();
		$this->process_book();
		$this->process_distance();
		$this->process_twitter();
		$this->process_youtube();
	}

	private function process_blog()
	{
		$blog_result = BlogCollector::getMissingBlogs();
		$blog_result = $this->remove_existing($blog_result, 'blog');
		$this->add_posts($blog_result, 'blog');
	}

	private function process_book()
	{
		$book_result = BookCollector::getMissingBooks();
		$book_result = $this->remove_existing($book_result, 'book');
		$this->add_posts($book_result, 'book');
	}

	private function process_distance()
	{
		$distance_result = DistanceCollector::getMissingDistances();
		$distance_result = $this->remove_existing($distance_result, 'distance');
		$this->add_posts($distance_result, 'distance');
	}

	private function process_twitter()
	{
		$twitter_result = TwitterCollector::getMissingTweets();
		$twitter_result = $this->remove_existing($twitter_result, 'twitter');
		$this->add_posts($twitter_result, 'twitter');
	}

	private function process_youtube()
	{
		$youtube_result = YouTubeCollector::getMissingVideos();
		$youtube_result = $this->remove_existing($youtube_result, 'youtube');
		$this->add_posts($youtube_result, 'youtube');
	}

	private function remove_existing($result, $type)
	{
		foreach($result as $key => $row)
		{
			$stream_result = ActivityCollector::getPostByFields($row->id, $type);
			if($stream_result)
				unset($result[$key]);
		}
		return $result;
	}

	private function add_posts($result, $type)
	{
		foreach($result as $row)
		{
			$query = sprintf(self::$QUERY, $type, $row->id, $row->date);
			Database::execute($query);
		}
	}

}