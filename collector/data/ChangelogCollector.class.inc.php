<?

Loader::load('collector', 'Collector');

final class ChangelogCollector extends Collector
{

	public static function getMostRecentChange()
	{
		$query = "SELECT * FROM `jpemeric_data`.`changeset` ORDER BY `number` DESC LIMIT 1";
		return self::run_row_query($query);
	}

	public static function getLast20Changes()
	{
		$query = "SELECT * FROM `jpemeric_data`.`changeset` WHERE `message` <> '' ORDER BY `number` DESC LIMIT 20";
		return self::run_query($query);
	}

}