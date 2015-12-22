<?

Loader::load('collector', 'Collector');

final class WatercourseCollector extends Collector
{

	public static function getById($id)
	{
		$query = "
			SELECT
				`watercourse`.`name`,
				`watercourse`.`alias`
			FROM
				`jpemeric_waterfall`.`watercourse`
			WHERE
				`watercourse`.`id` = '{$id}'
			LIMIT 1";
			
		return self::run_row_query($query);
	}

	public static function getByAlias($alias)
	{
		$alias = self::escape($alias);
		
		$query = "
			SELECT
				`watercourse`.`id`,
				`watercourse`.`name`,
				`watercourse`.`alias`,
				`watercourse`.`header`,
				`watercourse`.`description`,
				`watercourse`.`introduction`,
                `watercourse`.`parent`,
				`photo`.`name` AS `photo`,
				`photo_category`.`name` AS `photo_category`,
				`photo`.`description` AS `photo_description`
			FROM
				`jpemeric_waterfall`.`watercourse`
					LEFT JOIN (
						`jpemeric_image`.`photo`
							INNER JOIN
								`jpemeric_image`.`photo_category`
									ON `photo_category`.`id` = `photo`.`category`
						) ON `photo`.`id` = `watercourse`.`image`
			WHERE
				`watercourse`.`alias` = '{$alias}'
			LIMIT 1";
			
		return self::run_row_query($query);
	}

	public static function getWatercourseList()
	{
		$query = "
			SELECT
				`sum_table`.`name`,
				`sum_table`.`alias`,
				SUM(`count`) AS `count`
			FROM
				(
					(
					SELECT
						`watercourse`.`name`,
						`watercourse`.`alias`,
						`parent_count`.`count`
					FROM
						(
						SELECT
							COUNT(1) AS `count`,
							`parent` AS `id`
						FROM
							`jpemeric_waterfall`.`watercourse`
								INNER JOIN
									`jpemeric_waterfall`.`waterfall`
										ON `waterfall`.`watercourse` = `watercourse`.`id`
						WHERE
							`watercourse`.`parent` <> '0' &&
							`waterfall`.`is_public` = '1'
						GROUP BY
							`watercourse`.`id`
						) AS `parent_count`
							INNER JOIN
								`jpemeric_waterfall`.`watercourse`
									ON `parent_count`.`id` = `watercourse`.`id`
					WHERE
						`watercourse`.`has_page` = '1'
					)
				UNION ALL
					(
					SELECT
						`watercourse`.`name`,
						`watercourse`.`alias`,
						COUNT(1) AS `count`
					FROM
						`jpemeric_waterfall`.`watercourse`
							INNER JOIN
								`jpemeric_waterfall`.`waterfall`
									ON `waterfall`.`watercourse` = `watercourse`.`id`
					WHERE
						`watercourse`.`parent` = '0' &&
						`watercourse`.`has_page` = '1' &&
						`waterfall`.`is_public` = '1'
					GROUP BY
						`watercourse`.`id`
					)
				) AS `sum_table`
			GROUP BY
				`sum_table`.`alias`
			ORDER BY
				`sum_table`.`name`";
		
		return self::run_query($query);
	}

	public static function getLogListForWatercourse($watercourse, $total, $offset = 0)
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
				(`watercourse`.`id` = '{$watercourse}' || `watercourse`.`parent` = '{$watercourse}') &&
				`waterfall`.`is_public` = '1'
			ORDER BY
				`waterfall`.`name`,
				`watercourse`
			LIMIT
				{$offset}, {$total}";
		return self::run_query($query);
	}

    public static function getParentWatercourse($watercourse)
    {
    }

	public static function getLogCountForWatercourse($watercourse)
	{
		$query = "
			SELECT
				SUM(`count`) AS `count`
			FROM
				(
					(
					SELECT
						`count`
					FROM
						(
						SELECT
							COUNT(1) AS `count`,
							`parent` AS `id`
						FROM
							`jpemeric_waterfall`.`watercourse`
								INNER JOIN
									`jpemeric_waterfall`.`waterfall`
										ON `waterfall`.`watercourse` = `watercourse`.`id`
						WHERE
							`watercourse`.`parent` = '{$watercourse}' &&
							`waterfall`.`is_public` = '1'
						GROUP BY
							`watercourse`.`parent`
						) AS `parent_count`
							INNER JOIN
								`jpemeric_waterfall`.`watercourse`
									ON
										`watercourse`.`id` = `parent_count`.`id`
					WHERE
						`watercourse`.`has_page` = '1'
					)
				UNION ALL
					(
					SELECT
						COUNT(1) AS `count`
					FROM
						`jpemeric_waterfall`.`watercourse`
							INNER JOIN
								`jpemeric_waterfall`.`waterfall`
									ON `waterfall`.`watercourse` = `watercourse`.`id`
					WHERE
						`watercourse`.`id` = '{$watercourse}' &&
						`watercourse`.`has_page` = '1' &&
						`waterfall`.`is_public` = '1'
					)
				) AS `sum_table`";
		
		return self::get_count($query);
	}

}