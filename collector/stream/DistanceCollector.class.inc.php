<?

Loader::load('collector', 'Collector');

final class DistanceCollector extends Collector
{

	public static function getMissingDistances()
	{
		$query = "SELECT `id`, `date` FROM `jpemeric_stream`.`distance` WHERE `id` NOT IN (SELECT `type_id` FROM `jpemeric_stream`.`post` WHERE `type` = 'distance')";
		return self::run_query($query);
	}

	public static function getRow($id)
	{
		$query = "SELECT * FROM `jpemeric_stream`.`distance` WHERE `id` = '{$id}'";
		return self::run_row_query($query);
	}

	public static function getDistanceByFields($date, $type, $distance)
	{
		$type = self::escape($type);
		$distance = self::escape($distance);
		$query = "SELECT * FROM `jpemeric_stream`.`distance` WHERE `date` = '{$date}' && `type` = '{$type}' && `distance` = '{$distance}' LIMIT 1";
		return self::run_row_query($query);
	}

}