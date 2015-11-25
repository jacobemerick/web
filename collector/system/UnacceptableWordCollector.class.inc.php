<?

Loader::load('collector', 'Collector');

final class UnacceptableWordCollector extends Collector
{

	public static function getWords()
	{
		$query = "SELECT * FROM `jpemeric_system`.`unacceptable_word` ORDER BY `word`";
		return self::run_query($query);
	}

}