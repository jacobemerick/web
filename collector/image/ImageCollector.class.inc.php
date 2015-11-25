<?

Loader::load('collector', 'Collector');

final class ImageCollector extends Collector
{

	public static function getImageDescription($category, $photo, $extension)
	{
		$query = "SELECT `description` FROM `jpemeric_image`.`image` WHERE `name` = '{$photo}' && `extension` = '{$extension}' && `category` = '{$category}' LIMIT 1";
		return self::run_row_query($query);
	}

	public static function getImage($id)
	{
		$query = "SELECT * FROM `jpemeric_image`.`image` WHERE `id` = '{$id}' LIMIT 1";
		return self::run_row_query($query);
	}

}