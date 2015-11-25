<?

Loader::load('collector', 'Collector');

final class YouTubeCollector extends Collector
{

	public static function getMissingVideos()
	{
		$query = "SELECT `id`, `date` FROM `jpemeric_stream`.`youtube` WHERE `id` NOT IN (SELECT `type_id` FROM `jpemeric_stream`.`post` WHERE `type` = 'youtube')";
		return self::run_query($query);
	}

	public static function getRow($id)
	{
		$query = "SELECT * FROM `jpemeric_stream`.`youtube` WHERE `id` = '{$id}'";
		return self::run_row_query($query);
	}

	public static function checkForVideoByVideoID($video_id)
	{
		$query = "SELECT 1 FROM `jpemeric_stream`.`youtube` WHERE `video_id` = '{$video_id}' LIMIT 1";
		return self::check_exists($query);
	}

}