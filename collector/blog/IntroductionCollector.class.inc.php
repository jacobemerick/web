<?

Loader::load('collector', 'Collector');

final class IntroductionCollector extends Collector
{

	public static function getRow($type, $value = '')
	{
		$query = "SELECT `title`,`content`,`image` FROM `jpemeric_blog`.`introduction` WHERE `type` = '{$type}' && `value` = '{$value}' LIMIT 1";
		return self::run_row_query($query);
	}

}