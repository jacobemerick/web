<?

Loader::load('collector', 'Collector');

final class TwitterCollector extends Collector
{

	public static function getMissingTweets()
	{
		$query = "SELECT `id`, `date` FROM `jpemeric_stream`.`twitter` WHERE `id` NOT IN (SELECT `type_id` FROM `jpemeric_stream`.`post` WHERE `type` = 'twitter') && (`is_reply` = '0' || `retweets` > '0' || `favorites` > '0')";
		return self::run_query($query);
	}

	public static function getRow($id)
	{
		$query = "SELECT * FROM `jpemeric_stream`.`twitter` WHERE `id` = '{$id}'";
		return self::run_row_query($query);
	}

	public static function getTweetByFields($date, $text)
	{
		$query = "SELECT * FROM `jpemeric_stream`.`twitter` WHERE `date` = '{$date}' && `text` = '{$text}' LIMIT 1";
		return self::run_row_query($query);
	}

}