<?

Loader::load('collector', 'Collector');

final class TwitterCollector extends Collector
{

	public static function getRecentTweets()
	{
		$date = date('Y-m-d', strtotime('-7 days'));
		$query = "SELECT * FROM `jpemeric_data`.`twitter` WHERE `date` >= '{$date}' && `reply` = '0' && `display` = '1' ORDER BY `date` DESC";
		return self::run_query($query);
	}

	public static function getTweetByFields($date, $text)
	{
		$date = self::escape($date);
		$text = self::escape($text);
		$query = "SELECT * FROM `jpemeric_data`.`twitter` WHERE `date` = '{$date}' && `text` = '{$text}' LIMIT 1";
		return self::run_row_query($query);
	}

}