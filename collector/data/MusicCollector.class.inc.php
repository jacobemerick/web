<?

Loader::load('collector', 'Collector');

final class MusicCollector extends Collector
{

	public static function getPlayedMusicForRange($start_date, $end_date)
	{
		$query = "SELECT `album`,`artist`,`count`,`date` FROM `jpemeric_data`.`popular_music` WHERE `date` >= '{$start_date}' && `date` <= '{$end_date}' && `display` = '1' ORDER BY `date` DESC";
		return self::run_query($query);
	}

	public static function getPlayCountOverLastSevenDays($album, $artist, $date)
	{
		$album = self::escape($album);
		$artist = self::escape($artist);
		
		$query = "SELECT SUM(`count`) AS `playcount` FROM `jpemeric_data`.`popular_music` WHERE `album` = '{$album}' && `artist` = '{$artist}' && `date` > '{$date}' LIMIT 1";
		return self::run_row_query($query);
	}

}