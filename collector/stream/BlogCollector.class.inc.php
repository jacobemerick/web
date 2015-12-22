<?

Loader::load('collector', 'Collector');

final class BlogCollector extends Collector
{

	public static function getMissingBlogs()
	{
		$query = "SELECT `id`,`date` FROM `jpemeric_stream`.`blog` WHERE `id` NOT IN (SELECT `type_id` FROM `jpemeric_stream`.`post` WHERE `type` = 'blog')";
		return self::run_query($query);
	}

	public static function getRow($id)
	{
		$query = "SELECT * FROM `jpemeric_stream`.`blog` WHERE `id` = '{$id}'";
		return self::run_row_query($query);
	}

	public static function getBlogByTitle($title)
	{
		$title = self::escape($title);
		$query = "SELECT * FROM `jpemeric_stream`.`blog` WHERE `title` = '{$title}' LIMIT 1";
		return self::run_row_query($query);
	}

}