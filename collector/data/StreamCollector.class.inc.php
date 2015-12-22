<?

Loader::load('collector', 'Collector');

final class StreamCollector extends Collector
{

	public static function getRecentActivity($total = 5)
	{
		$query = "SELECT `text`, `type`, `date` FROM `jpemeric_data`.`about` WHERE `type` IN ('1','4','5','7','8','9') ORDER BY `date` DESC LIMIT 0, {$total}";
		return self::run_query($query);
	}

	public static function getAll()
	{
		$query = "SELECT * FROM `jpemeric_data`.`about` WHERE `type` IN ('1','4','5','7','8','9') ORDER BY `date` DESC";
		return self::run_query($query);
	}

	public static function getCount()
	{
		$query = "SELECT COUNT(1) AS `count` FROM `jpemeric_data`.`about` WHERE `type` IN ('1','4','5','7','8','9') LIMIT 1";
		return self::run_row_query($query)->count;
	}

	public static function getCountForType($type_id)
	{
		$query = "SELECT COUNT(1) AS `count` FROM `jpemeric_data`.`about` WHERE `type` = '{$type_id}' LIMIT 1";
		return self::run_row_query($query)->count;
	}

	public static function getInRange($offset, $start)
	{
		$query = "SELECT * FROM `jpemeric_data`.`about` WHERE `type` IN ('1','4','5','7','8','9') ORDER BY `date` DESC LIMIT {$start}, {$offset}";
		return self::run_query($query);
	}

	public static function getByTypeInRange($type_id, $offset, $start)
	{
		$query = "SELECT * FROM `jpemeric_data`.`about` WHERE `type` = '{$type_id}' ORDER BY `date` DESC LIMIT {$start}, {$offset}";
		return self::run_query($query);
	}

	public static function getActivityByFields($activity_id, $activity_type)
	{
		$query = "SELECT * FROM `jpemeric_data`.`about` WHERE `data_id` = '{$activity_id}' && `type` = '{$activity_type}' LIMIT 1";
		return self::run_row_query($query);
	}

	public static function getSingle($post_id)
	{
		$post_id = self::escape($post_id);
		$query = "SELECT * FROM `jpemeric_data`.`about` WHERE `id` = '{$post_id}' LIMIT 1";
		return self::run_row_query($query);
	}

}
