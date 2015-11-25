<?

Loader::load('collector', 'Collector');

final class LogCollector extends Collector
{

	public static function getList($total, $offset = 0)
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
				`log`.`is_public` = '1'
			ORDER BY
				`log`.`date` DESC
			LIMIT
				{$offset}, {$total}";
		return self::run_query($query);
	}

    public static function getRecentList($total)
    {
        $query = "
            SELECT
                `log`.`title`,
                `log`.`alias`,
                `log`.`publish_date`,
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
                `log`.`is_public` = '1'
            ORDER BY
                `log`.`publish_date` DESC,
                `log`.`date` DESC
            LIMIT
                {$total}";
        return self::run_query($query);
    }

	public static function getListCount()
	{
		$query = "
			SELECT
				COUNT(1) AS `count`
			FROM
				`jpemeric_waterfall`.`log`
			WHERE
				`is_public` = '1'";
		return self::get_count($query);
	}

	public static function getCompanionListForLog($log)
	{
		$query = "
			SELECT
				`companion`.`name`,
				`companion`.`alias`
			FROM
				`jpemeric_waterfall`.`companion`
					INNER JOIN
						`jpemeric_waterfall`.`log_companion_map`
							ON `log_companion_map`.`companion` = `companion`.`id`
			WHERE
				`log_companion_map`.`log` = '{$log}'";
		return self::run_query($query);
	}

	public static function getWaterfallListForLog($log)
	{
		$query = "
			SELECT
				`waterfall`.`name`,
				`waterfall`.`alias`,
				`watercourse`.`alias` AS `watercourse_alias`
			FROM
				`jpemeric_waterfall`.`waterfall`
					INNER JOIN
						`jpemeric_waterfall`.`log_waterfall_map` ON
							`log_waterfall_map`.`waterfall` = `waterfall`.`id`
					INNER JOIN
						`jpemeric_waterfall`.`watercourse` ON
							`watercourse`.`id` = `waterfall`.`watercourse`
			WHERE
				`log_waterfall_map`.`log` = '{$log}' AND
				`waterfall`.`is_public` = '1'
			ORDER BY
				`log_waterfall_map`.`order`";
		return self::run_query($query);
	}

	public static function getLogListForWaterfall($waterfall)
	{
		$query = "
			SELECT
				`log`.`title`,
				`log`.`alias`,
				`log`.`date`
			FROM
				`jpemeric_waterfall`.`log`
					INNER JOIN
						`jpemeric_waterfall`.`log_waterfall_map` ON
							`log_waterfall_map`.`log` = `log`.`id` AND
                            `log_waterfall_map`.`waterfall` = '{$waterfall}'
			WHERE
				`log`.`is_public` = '1'
			ORDER BY
				`log`.`date`";
		return self::run_query($query);
	}

	public static function getTagListForLog($log)
	{
		$query = "
			SELECT
				`tag`.`name`,
				`tag`.`alias`
			FROM
				`jpemeric_waterfall`.`tag`
					INNER JOIN
						`jpemeric_waterfall`.`log_tag_map`
							ON `log_tag_map`.`tag` = `tag`.`id` && `log_tag_map`.`log` = '{$log}'";
		return self::run_query($query);
	}

	public static function getByAlias($alias)
	{
		$alias = self::escape($alias);
		
		$query = "
			SELECT
				`log`.`id`,
				`log`.`title`,
				`log`.`date`,
				`log`.`publish_date`,
				`log`.`introduction`,
				`log`.`body`,
				`log`.`alias`,
				`log`.`album`,
				`photo_category`.`name` AS `image_category`,
				`photo`.`name` AS `image_name`,
				`photo`.`description` AS `image_description`
			FROM
				`jpemeric_waterfall`.`log`
				    INNER JOIN `jpemeric_image`.`photo` ON
				        `photo`.`id` = `log`.`image`
				    INNER JOIN `jpemeric_image`.`photo_category` ON
				        `photo_category`.`id` = `photo`.`category`
			WHERE
				`log`.`alias` = '{$alias}' &&
				`log`.`is_public` = '1'
			LIMIT 1";
		
		return self::run_row_query($query);
	}

    public static function getByDate($date)
    {
        $date = self::escape($date);
        
        $query = "
            SELECT
                `log`.`alias`
            FROM
                `jpemeric_waterfall`.`log`
            WHERE
                `log`.`date` = '{$date}' AND
                `log`.`is_public` = '1'
            LIMIT 1";
        
        return self::run_row_query($query);
    }
	
	public static function getById($log)
	{
		$query = "
			SELECT
				`title`,
				`date`,
				`alias`
			FROM
				`jpemeric_waterfall`.`log`
			WHERE
				`id` = '{$log}' AND
				`is_public` = '1'
			LIMIT 1";
		return self::run_row_query($query);
	}

	public static function getPreviousLog($log)
	{
		$query = "
			SELECT
				`title`,
				`date`,
				`alias`
			FROM
				`jpemeric_waterfall`.`log`
			WHERE
				`date` < (
					SELECT
						`date`
					FROM
						`jpemeric_waterfall`.`log`
					WHERE
						`id` = '{$log}') &&
				`is_public` = '1'
			ORDER BY
				`date` DESC
			LIMIT 1";
		
		return self::run_row_query($query);
	}

	public static function getNextLog($log)
	{
		$query = "
			SELECT
				`title`,
				`date`,
				`alias`
			FROM
				`jpemeric_waterfall`.`log`
			WHERE
				`date` > (
					SELECT
						`date`
					FROM
						`jpemeric_waterfall`.`log`
					WHERE
						`id` = '{$log}') &&
				`is_public` = '1'
			ORDER BY
				`date` ASC
			LIMIT 1";
		
		return self::run_row_query($query);
	}

}
