<?

Loader::load('collector', 'Collector');

final class BlogCollector extends Collector
{

	public static function getRecentBlogs()
	{
		$date = date('Y-m-d', strtotime('-7 days'));
		$query = "SELECT * FROM `jpemeric_data`.`blog` WHERE `date` >= '{$date}' ORDER BY `date` DESC";
		return self::run_query($query);
	}

	public static function getBlogByTitle($title)
	{
		$title = self::escape($title);
		$query = "SELECT * FROM `jpemeric_data`.`blog` WHERE `title` = '{$title}' LIMIT 1";
		return self::run_row_query($query);
	}

}