<?

Loader::load('collector', 'Collector');

final class DistanceCollector extends Collector
{

	public static function getRecentCompletedDistances()
	{
		$date = date('Y-m-d', strtotime('-7 days'));
		$query = "SELECT * FROM `jpemeric_data`.`distance` WHERE `date` >= '{$date}' && `display` = 1 ORDER BY `date` DESC";
		return self::run_query($query);
	}

	public static function getDistanceByFields($date, $type, $distance)
	{
		$type = self::escape($type);
		$distance = self::escape($distance);
		$query = "SELECT * FROM `jpemeric_data`.`distance` WHERE `date` = '{$date}' && `type` = '{$type}' && `distance` = '{$distance}' LIMIT 1";
		return self::run_row_query($query);
	}

}