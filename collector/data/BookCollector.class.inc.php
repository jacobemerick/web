<?

Loader::load('collector', 'Collector');

final class BookCollector extends Collector
{

	public static function getRecentCompletedBooks()
	{
		$date = date('Y-m-d', strtotime('-7 days'));
		$query = "SELECT * FROM `jpemeric_data`.`book` WHERE `in_progress` = '0' && `date` >= '{$date}' && `title` IN (SELECT `title` FROM `jpemeric_data`.`book` WHERE `in_progress` = '1') ORDER BY `date` DESC";
		return self::run_query($query);
	}

	public static function getBookByFields($title, $author, $in_progress)
	{
		$title = self::escape($title);
		$author = self::escape($author);
		$query = "SELECT * FROM `jpemeric_data`.`book` WHERE `title` = '{$title}' && `author` = '{$author}' && `in_progress` = '{$in_progress}' LIMIT 1";
		return self::run_row_query($query);
	}

}