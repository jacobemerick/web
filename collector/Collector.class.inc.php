<?

Loader::loadInstance('utility', 'Database');

abstract class Collector
{

	protected static function run_query($query)
	{
		return Database::select($query);
	}

	protected static function run_row_query($query)
	{
		return Database::selectRow($query);
	}

	protected static function get_count($query)
	{
		return Database::selectRow($query)->count;
	}

	protected static function check_exists($query)
	{
		return Database::selectRow($query) !== null;
	}

	protected static function escape($string)
	{
		return Database::escape($string);
	}

}