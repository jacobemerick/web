<?

Loader::load('collector', 'Collector');

final class AlbumCollector extends Collector
{

	public static function getPhotoListForAlbum($album)
	{
		$query = "
			SELECT
				`photo`.`name`,
				`photo_category`.`name` AS `category`,
				`photo`.`description`,
				`photographer`.`name` AS `photographer`,
				`photo`.`date_taken` AS `date`,
				`photo_meta`.`height`,
				`photo_meta`.`width`
			FROM
				`jpemeric_image`.`album`
					INNER JOIN
						`jpemeric_image`.`album_photo` ON
							`album_photo`.`album` = `album`.`id`
					INNER JOIN
						`jpemeric_image`.`photo` ON
							`photo`.`id` = `album_photo`.`photo`
					INNER JOIN
						`jpemeric_image`.`photo_category` ON
							`photo_category`.`id` = `photo`.`category`
					INNER JOIN
						`jpemeric_image`.`photographer` ON
							`photographer`.`id` = `photo`.`photographer`
					INNER JOIN
						`jpemeric_image`.`photo_meta` ON
							`photo_meta`.`photo` = `photo`.`id`
			WHERE
				`album` = '{$album}'
			ORDER BY
				`photo`.`date_taken`";
		
		return self::run_query($query);
	}

}