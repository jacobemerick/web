<?

Loader::load('collector', 'Collector');

final class CompanionCollector extends Collector
{

	public static function getByAlias($alias)
	{
		$alias = self::escape($alias);
		
		$query = "
			SELECT
				`companion`.`id`,
				`companion`.`name`,
				`companion`.`alias`,
				`companion`.`title`,
				`companion`.`description`,
				`companion`.`introduction`,
				`photo`.`name` AS `photo`,
				`photo_category`.`name` AS `photo_category`,
				`photo`.`description` AS `photo_description`
			FROM
				`jpemeric_waterfall`.`companion`
					LEFT JOIN (
						`jpemeric_image`.`photo`
							INNER JOIN
								`jpemeric_image`.`photo_category`
									ON `photo_category`.`id` = `photo`.`category`
						) ON `photo`.`id` = `companion`.`image`
			WHERE
				`companion`.`alias` = '{$alias}'
			LIMIT 1";
		
		return self::run_row_query($query);
	}

	public static function getCompanionList()
	{
		$query = "
			SELECT
				`companion`.`name`,
				`companion`.`alias`,
				COUNT(1) AS `count`
			FROM
				`jpemeric_waterfall`.`companion`
					INNER JOIN
						`jpemeric_waterfall`.`log_companion_map`
							ON `log_companion_map`.`companion` = `companion`.`id`
					INNER JOIN
						`jpemeric_waterfall`.`log`
							ON `log`.`id` = `log_companion_map`.`log`
			WHERE
				`log`.`is_public` = '1'
			GROUP BY
				`companion`.`alias`
			ORDER BY
				`companion`.`name`";
		
		return self::run_query($query);
	}

	public static function getLogListForCompanion($companion, $total, $offset = 0)
	{
		$query = "
			SELECT
				`log`.`id`,
				`log`.`title`,
				`log`.`alias`,
				`log`.`date`,
				`log`.`introduction`,
				`photo`.`name` AS `photo`,
				`photo_category`.`name` AS `photo_category`,
				`photo`.`description` AS `photo_description`
			FROM
				`jpemeric_waterfall`.`log`
					INNER JOIN
						`jpemeric_waterfall`.`log_companion_map`
							ON `log_companion_map`.`log` = `log`.`id`
					LEFT JOIN (
						`jpemeric_image`.`photo`
							INNER JOIN
								`jpemeric_image`.`photo_category`
									ON `photo_category`.`id` = `photo`.`category`
						) ON `photo`.`id` = `log`.`image`
			WHERE
				`log_companion_map`.`companion` = '{$companion}' &&
				`log`.`is_public` = '1'
			ORDER BY
				`log`.`date` DESC
			LIMIT
				{$offset}, {$total}";
		return self::run_query($query);
	}

	public static function getLogCountForCompanion($companion)
	{
		$query = "
			SELECT
				COUNT(1) AS `count`
			FROM
				`jpemeric_waterfall`.`log`
					INNER JOIN
						`jpemeric_waterfall`.`log_companion_map`
							ON `log_companion_map`.`log` = `log`.`id`
			WHERE
				`log_companion_map`.`companion` = '{$companion}' &&
				`log`.`is_public` = '1'";
		return self::get_count($query);
	}

}