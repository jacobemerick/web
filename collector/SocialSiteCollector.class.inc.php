<?

Loader::load('collector', 'Collector');

final class SocialSiteCollector extends Collector
{

	public static function getSitesForHomePage()
	{
		$query = "SELECT * FROM `jpemeric_system`.`social_site` ORDER BY `name`";
		return self::run_query($query);
	}

}