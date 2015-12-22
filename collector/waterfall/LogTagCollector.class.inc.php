<?

Loader::load('collector', 'Collector');

final class LogTagCollector extends Collector
{

	public static function getTag($alias)
	{
		$alias = self::escape($alias);
		
		$query = "
			SELECT
				`tag`.`id`,
				`tag`.`name`,
				`tag`.`alias`
			FROM
				`jpemeric_waterfall`.`tag`
			WHERE
				`tag`.`alias` = '{$alias}'
			LIMIT 1";
		
		return self::run_row_query($query);
	}

	public static function getLogListForTag($tag, $total, $offset = 0)
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
						`jpemeric_waterfall`.`log_tag_map`
							ON `log_tag_map`.`log` = `log`.`id`
					LEFT JOIN (
						`jpemeric_image`.`photo`
							INNER JOIN
								`jpemeric_image`.`photo_category`
									ON `photo_category`.`id` = `photo`.`category`
						) ON `photo`.`id` = `log`.`image`
			WHERE
				`log_tag_map`.`tag` = '{$tag}' &&
				`log`.`is_public` = '1'
			ORDER BY
				`log`.`date` DESC
			LIMIT
				{$offset}, {$total}";
		
		return self::run_query($query);
	}

	public static function getLogCountForTag($tag)
	{
		$query = "
			SELECT
				COUNT(1) AS `count`
			FROM
				`jpemeric_waterfall`.`log`
					INNER JOIN
						`jpemeric_waterfall`.`log_tag_map`
							ON `log_tag_map`.`log` = `log`.`id`
			WHERE
				`log_tag_map`.`tag` = '{$tag}' &&
				`log`.`is_public` = '1'";
		
		return self::get_count($query);
	}

}