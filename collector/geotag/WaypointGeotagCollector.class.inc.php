<?

Loader::load('collector', 'Collector');

final class WaypointGeotagCollector extends Collector
{

	public static function getAllWaypoints($maximum, $minimum)
	{
		$query = "SELECT `description`,`type`,`latitude`,`longitude`,`elevation` FROM `jpemeric_geotag`.`coordinate`,`jpemeric_geotag`.`waypoint` WHERE `coordinate`.`id` = `waypoint`.`coordinate` && `coordinate`.`latitude` < '{$maximum->latitude}' && `coordinate`.`latitude` < '{$minimum->longitude}' && `coordinate`.`longitude` < '{$maximum->longitude}' && `coordinate`.`longitude` > '{$minimum->longitude}'";
		return self::run_query($query);
	}

	public static function getAllTypeWaypoints($type, $maximum, $minimum)
	{
		$query = "SELECT `description`,`type`,`latitude`,`longitude`,`elevation` FROM `jpemeric_geotag`.`coordinate`,`jpemeric_geotag`.`waypoint` WHERE `coordinate`.`id` = `waypoint`.`coordinate` && `waypoint`.`type` = '{$type}' && `coordinate`.`latitude` < '{$maximum->latitude}' && `coordinate`.`latitude` < '{$minimum->longitude}' && `coordinate`.`longitude` < '{$maximum->longitude}' && `coordinate`.`longitude` > '{$minimum->longitude}'";
		return self::run_query($query);
	}

}