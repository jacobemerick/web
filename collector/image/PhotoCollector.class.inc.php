<?

Loader::load('collector', 'Collector');

final class PhotoCollector extends Collector
{

	public static function fetchRow($category, $photo)
	{
		$query = "
			SELECT
				`photo`.`name`,
				`photo_category`.`name` AS `category`,
				`photo`.`description`,
				`photographer`.`name` AS `photographer`,
				`photo`.`date_taken` AS `date`
			FROM
				`jpemeric_image`.`photo`,
				`jpemeric_image`.`photo_category`,
				`jpemeric_image`.`photographer`
			WHERE
				`photo`.`category` = `photo_category`.`id` &&
				`photo`.`photographer` = `photographer`.`id` &&
				`photo`.`name` = '{$photo}' &&
				`photo_category`.`name` = '{$category}'
			LIMIT 1";
		return self::run_row_query($query);
	}

	public static function getRow($id)
	{
		$query = "
			SELECT
				`photo`.`name`,
				`photo_category`.`name` AS `category`,
				`photo`.`description`,
				`photographer`.`name` AS `photographer`,
				`photo`.`date_taken` AS `date`
			FROM
				`jpemeric_image`.`photo`,
				`jpemeric_image`.`photo_category`,
				`jpemeric_image`.`photographer`
			WHERE
				`photo`.`category` = `photo_category`.`id` &&
				`photo`.`photographer` = `photographer`.`id` &&
				`photo`.`id` = '{$id}'
			LIMIT 1";
		return self::run_row_query($query);
	}

}