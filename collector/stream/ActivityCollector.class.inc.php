<?

Loader::load('collector', 'Collector');

final class ActivityCollector extends Collector
{

	public static function getRecent($count = 5)
	{
		$query = "SELECT * FROM `jpemeric_stream`.`post` ORDER BY `date` DESC LIMIT 0, {$count}";
		return self::run_query($query);
	}

	public static function getAll()
	{
		$query = "SELECT `id`,`type` FROM `jpemeric_stream`.`post` ORDER BY `date` DESC";
		return self::run_query($query);
	}

	public static function getPostByFields($type_id, $type)
	{
		$query = "SELECT 1 FROM `jpemeric_stream`.`post` WHERE `type_id` = '{$type_id}' && `type` = '{$type}' LIMIT 1";
		return self::check_exists($query);
	}

	public static function getPost($id)
	{
		$query = "SELECT * FROM `jpemeric_stream`.`post` WHERE `id` = '{$id}' LIMIT 1";
		return self::run_row_query($query);
	}

	public static function getCount()
	{
		$query = "SELECT COUNT(1) AS `count` FROM `jpemeric_stream`.`post`";
		return self::get_count($query);
	}

	public static function getInRange($offset, $start)
	{
		$query = "SELECT * FROM `jpemeric_stream`.`post` ORDER BY `date` DESC LIMIT {$start}, {$offset}";
		return self::run_query($query);
	}

	public static function getCountForTag($tag)
	{
		$tag = self::escape($tag);
		$query = "SELECT COUNT(1) AS `count` FROM `jpemeric_stream`.`post` WHERE `type` = '{$tag}'";
		return self::get_count($query);
	}

	public static function getByTagInRange($tag, $offset, $start)
	{
		$tag = self::escape($tag);
		$query = "SELECT * FROM `jpemeric_stream`.`post` WHERE `type` = '{$tag}' ORDER BY `date` DESC LIMIT {$start}, {$offset}";
		return self::run_query($query);
	}

}