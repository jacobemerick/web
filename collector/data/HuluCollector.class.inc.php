<?

Loader::load('collector', 'Collector');

final class HuluCollector extends Collector
{

	public static function getRecentWatchedShows()
	{
		$date = date('Y-m-d', strtotime('-7 days'));
		$query = "SELECT * FROM `jpemeric_data`.`hulu` WHERE `date` >= '{$date}' && `action` = '1' && `display` = '1' ORDER BY `date` DESC";
		return self::run_query($query);
	}

	public static function getHuluByFields($title, $action)
	{
		$title = self::escape($title);
		$action = self::escape($action);
		$query = "SELECT * FROM `jpemeric_data`.`hulu` WHERE `video` = '{$title}' && `action` = '{$action}' LIMIT 1";
		return self::run_row_query($query);
	}

}