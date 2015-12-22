<?

Loader::load('collector', 'Collector');

final class BookCollector extends Collector
{

	public static function getMissingBooks()
	{
		$query = "SELECT `id`,`date_read` AS `date` FROM `jpemeric_stream`.`book` WHERE `id` NOT IN (SELECT `type_id` FROM `jpemeric_stream`.`post` WHERE `type` = 'book')";
		return self::run_query($query);
	}

	public static function getRow($id)
	{
		$query = "SELECT `id`,`title`,`author`,`image`,`date_read` AS `date` FROM `jpemeric_stream`.`book` WHERE `id` = '{$id}'";
		return self::run_row_query($query);
	}

	public static function getBookByFields($title, $author)
	{
		$query = "SELECT * FROM `jpemeric_stream`.`book` WHERE `title` = '{$title}' && `author` = '{$author}' LIMIT 1";
		return self::run_row_query($query);
	}

}