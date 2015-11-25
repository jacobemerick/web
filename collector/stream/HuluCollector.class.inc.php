<?

Loader::load('collector', 'Collector');

final class HuluCollector extends Collector
{

	public static function getRow($id)
	{
		$query = "SELECT * FROM `jpemeric_stream`.`hulu` WHERE `id` = '{$id}'";
		return self::run_row_query($query);
	}

}