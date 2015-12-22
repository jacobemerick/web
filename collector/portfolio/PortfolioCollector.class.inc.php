<?

Loader::load('collector', 'Collector');

final class PortfolioCollector extends Collector
{

	public static function getPieceByURI($uri)
	{
		$uri = self::escape($uri);
		$query = "SELECT * FROM `jpemeric_portfolio`.`piece` WHERE `title_url` = '{$uri}' && `display` = '1' LIMIT 1";
		return self::run_row_query($query);
	}

	public static function getImageById($id)
	{
		$id = self::escape($id);
		$query = "SELECT `id`,`name` FROM `jpemeric_portfolio`.`image` WHERE `id` = '{$id}' LIMIT 1";
		return self::run_row_query($query);
	}

	public static function getImagesForPiece($piece_id, $type)
	{
		$piece_id = self::escape($piece_id);
		$query = "SELECT `id`,`name` FROM `jpemeric_portfolio`.`image` WHERE `piece_id` = '{$piece_id}' && `type` = '{$type}'";
		return self::run_query($query);
	}

	public static function getTagsForPiece($piece_id)
	{
		$query = "SELECT `name` FROM `jpemeric_portfolio`.`ptlink`, `jpemeric_portfolio`.`tag` WHERE `ptlink`.`portfoliotag_id` = `tag`.`id` && `ptlink`.`portfoliopiece_id` = '{$piece_id}'";
		return self::run_query($query);
	}

	public static function getPiecesForCategory($category_id)
	{
		$query = "SELECT `title`,`title_url`,`category`,`name` AS `image` FROM `jpemeric_portfolio`.`piece`, `jpemeric_portfolio`.`image` WHERE `piece`.`id` = `image`.`piece_id` && `type` = '1' && `category` = '{$category_id}' && `display` = '1' ORDER BY `date` DESC";
		return self::run_query($query);
	}

	public static function getAllPieces()
	{
		$query = "SELECT `title`,`title_url`,`category` FROM `jpemeric_portfolio`.`piece` WHERE `display` = '1' ORDER BY `date` DESC";
		return self::run_query($query);
	}

}