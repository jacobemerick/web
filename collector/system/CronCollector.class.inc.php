<?

Loader::load('collector', 'Collector');

final class CronCollector extends Collector
{

	public static function getActiveCrons()
	{
		$query = "SELECT * FROM `jpemeric_system`.`cron` WHERE `active` = '1'";
		return self::run_query($query);
	}

}