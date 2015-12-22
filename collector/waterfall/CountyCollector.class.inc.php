<?

Loader::load('collector', 'Collector');

final class CountyCollector extends Collector
{

	public static function getByAlias($alias)
	{
		$alias = self::escape($alias);
		
		$query = "
			SELECT
				`county`.`id`,
				`county`.`name`,
				`county`.`alias`,
				`county`.`title`,
				`county`.`description`,
				`county`.`introduction`,
				`photo`.`name` AS `photo`,
				`photo_category`.`name` AS `photo_category`,
				`photo`.`description` AS `photo_description`
			FROM
				`jpemeric_waterfall`.`county`
					LEFT JOIN (
						`jpemeric_image`.`photo`
							INNER JOIN
								`jpemeric_image`.`photo_category`
									ON `photo_category`.`id` = `photo`.`category`
						) ON `photo`.`id` = `county`.`image`
			WHERE
				`county`.`alias` = '{$alias}'
			LIMIT 1";
		
		return self::run_row_query($query);
	}

	public static function getCountyList()
	{
		$query = "
			SELECT
				`county`.`name`,
				`county`.`alias`,
				COUNT(1) AS `count`
			FROM
				`jpemeric_waterfall`.`county`
					INNER JOIN
						`jpemeric_waterfall`.`waterfall`
							ON `waterfall`.`county` = `county`.`id`
			WHERE
				`waterfall`.`is_public` = '1'
			GROUP BY
				`county`.`alias`
			ORDER BY
				`county`.`name`";
		
		return self::run_query($query);
	}

	public static function getLogListForCounty($county, $total, $offset = 0)
	{
		$query = "
			SELECT
				`waterfall`.`id`,
				`waterfall`.`name`,
				`waterfall`.`alias` AS `waterfall_alias`,
				`waterfall`.`rating`,
				`photo`.`name` AS `photo`,
				`photo_category`.`name` AS `photo_category`,
				`photo`.`description` AS `photo_description`,
				`watercourse`.`name` AS `watercourse`,
				`watercourse`.`alias` AS `watercourse_alias`,
				`county`.`title` AS `county`
			FROM
				`jpemeric_waterfall`.`waterfall`
					LEFT JOIN (
						`jpemeric_image`.`photo`
							INNER JOIN
								`jpemeric_image`.`photo_category`
									ON `photo_category`.`id` = `photo`.`category`
						) ON `photo`.`id` = `waterfall`.`image`
					INNER JOIN
						`jpemeric_waterfall`.`watercourse`
							ON `watercourse`.`id` = `waterfall`.`watercourse`
					INNER JOIN
						`jpemeric_waterfall`.`county`
							ON `county`.`id` = `waterfall`.`county`
			WHERE
				`county`.`id` = '{$county}' &&
				`waterfall`.`is_public` = '1'
			ORDER BY
				`waterfall`.`name`,
				`watercourse`.`name`
			LIMIT
				{$offset}, {$total}";
		return self::run_query($query);
	}

	public static function getLogCountForCounty($county)
	{
		$query = "
			SELECT
				COUNT(1) AS `count`
			FROM
				`jpemeric_waterfall`.`waterfall`
					INNER JOIN
						`jpemeric_waterfall`.`watercourse`
							ON `watercourse`.`id` = `waterfall`.`watercourse`
			WHERE
				`waterfall`.`county` = '{$county}' &&
				`waterfall`.`is_public` = '1'";
		return self::get_count($query);
	}

}