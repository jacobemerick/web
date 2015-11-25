<?

Loader::load('collector', 'Collector');

final class PeriodCollector extends Collector
{

	public static function getByAlias($alias)
	{
		$alias = self::escape($alias);
		
		$query = "
			SELECT
				`period`.`id`,
				`period`.`name`,
				`period`.`alias`,
				`period`.`title`,
				`period`.`description`,
				`period`.`introduction`,
				`photo`.`name` AS `photo`,
				`photo_category`.`name` AS `photo_category`,
				`photo`.`description` AS `photo_description`
			FROM
				`jpemeric_waterfall`.`period`
					LEFT JOIN (
						`jpemeric_image`.`photo`
							INNER JOIN
								`jpemeric_image`.`photo_category`
									ON `photo_category`.`id` = `photo`.`category`
						) ON `photo`.`id` = `period`.`image`
			WHERE
				`period`.`alias` = '{$alias}'
			LIMIT 1";
		return self::run_row_query($query);
	}

	public static function getPeriodList()
	{
		$query = "
			SELECT
				`period`.`name`,
				`period`.`alias`,
				COUNT(1) AS `count`
			FROM
				`jpemeric_waterfall`.`period`
					INNER JOIN
						`jpemeric_waterfall`.`log`
							ON `log`.`period` = `period`.`id`
			WHERE
				`log`.`is_public` = '1'
			GROUP BY
				`period`.`alias`
			ORDER BY
				`period`.`id`";
		return self::run_query($query);
	}

	public static function getLogListForPeriod($period, $total, $offset = 0)
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
					LEFT JOIN (
						`jpemeric_image`.`photo`
							INNER JOIN
								`jpemeric_image`.`photo_category`
									ON `photo_category`.`id` = `photo`.`category`
						) ON `photo`.`id` = `log`.`image`
			WHERE
				`log`.`period` = '{$period}' &&
				`log`.`is_public` = '1'
			ORDER BY
				`log`.`date` DESC
			LIMIT
				{$offset}, {$total}";
		
		return self::run_query($query);
	}

	public static function getLogCountForPeriod($period)
	{
		$query = "
			SELECT
				COUNT(1) AS `count`
			FROM
				`jpemeric_waterfall`.`log`
			WHERE
				`period` = '{$period}' &&
				`is_public` = '1'";
		return self::get_count($query);
	}

}