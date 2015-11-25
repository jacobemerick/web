<?

Loader::load('collector', 'Collector');

final class SiteCollector extends Collector
{

	public static function getSitesForHomePage()
	{
		$query = "SELECT * FROM `jpemeric_system`.`site` WHERE `level` = '2' && `public` = '1' ORDER BY `name`";
		return self::run_query($query);
	}

	public static function getSitesForMenu()
	{
		$query = "SELECT * FROM `jpemeric_system`.`site` WHERE `public` = '1' ORDER BY `level`, `name`";
		return self::run_query($query);
	}

}