<?

Loader::load('collector', 'Collector');

final class WaterfallCollector extends Collector
{

	public static function getList($total, $offset = 0)
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
				`waterfall`.`is_public` = '1'
			ORDER BY
				`waterfall`.`name`,
				`watercourse`.`name`
			LIMIT
				{$offset}, {$total}";
		return self::run_query($query);
	}

    public static function getMapList()
    {
        $query = "
            SELECT
                `waterfall`.`name`,
                `waterfall`.`alias`,
                `coordinate`.`latitude`,
                `coordinate`.`longitude`,
                `watercourse`.`name` AS `watercourse`,
                `watercourse`.`alias` AS `watercourse_alias`,
                `photo`.`name` AS `photo`,
                `photo`.`description` AS `photo_description`,
                `photo_category`.`name` AS `photo_category`
            FROM
                `jpemeric_waterfall`.`waterfall`
                    INNER JOIN `jpemeric_waterfall`.`watercourse` ON
                        `watercourse`.`id` = `waterfall`.`watercourse`
                    INNER JOIN `jpemeric_geodata`.`coordinate` ON
                        `coordinate`.`id` = `waterfall`.`location`
                    INNER JOIN `jpemeric_image`.`photo` ON
                        `photo`.`id` = `waterfall`.`image`
                    INNER JOIN `jpemeric_image`.`photo_category` ON
                        `photo_category`.`id` = `photo`.`category`
            WHERE
                `waterfall`.`is_public` = '1'
            ORDER BY
                LENGTH(`waterfall`.`name`)";
        
        return self::run_query($query);
    }

	public static function getListCount()
	{
		$query = "
			SELECT
				COUNT(1) AS `count`
			FROM
				`jpemeric_waterfall`.`waterfall`
					INNER JOIN
						`jpemeric_waterfall`.`watercourse`
							ON `watercourse`.`id` = `waterfall`.`watercourse`
					INNER JOIN
						`jpemeric_waterfall`.`county`
							ON `county`.`id` = `waterfall`.`county`
			WHERE
				`waterfall`.`is_public` = '1'";
		return self::get_count($query);
	}

    public static function getNearbyList($waterfall)
    {
        $query = "
            SELECT
                `waterfall`.`name`,
                `waterfall`.`alias` AS `alias`,
                `watercourse`.`name` AS `watercourse`,
                `watercourse`.`alias` AS `watercourse_alias`,
                `waterfall_proximity_map`.`distance`
            FROM
                `jpemeric_waterfall`.`waterfall`
                    INNER JOIN `jpemeric_waterfall`.`waterfall_proximity_map` ON
                        `waterfall_proximity_map`.`nearby` = `waterfall`.`id` AND
                        `waterfall_proximity_map`.`waterfall` = '{$waterfall}'
                    INNER JOIN `jpemeric_waterfall`.`watercourse` ON
                        `watercourse`.`id` = `waterfall`.`watercourse`
            WHERE
                `waterfall`.`is_public` = '1'
            ORDER BY
                `waterfall`.`name`,
                `watercourse`.`name`";
        
        return self::run_query($query);
    }

    public static function getByOldAlias($alias)
    {
        $alias = self::escape($alias);
        
        $query = "
            SELECT
                `waterfall`.`alias`,
                `watercourse`.`alias` AS `watercourse_alias`
            FROM
                `jpemeric_waterfall`.`waterfall`
                    INNER JOIN `jpemeric_waterfall`.`watercourse` ON
                        `watercourse`.`id`  = `waterfall`.`watercourse`
            WHERE
                `waterfall`.`alias` = '{$alias}' &&
                `waterfall`.`is_public` = '1'
            LIMIT 1";
        
        return self::run_row_query($query);
    }

	public static function getByAlias($watercourse, $waterfall)
	{
		$watercourse = self::escape($watercourse);
		$waterfall = self::escape($waterfall);
		
		$query = "
			SELECT
				`waterfall`.`id` AS `id`,
				`waterfall`.`name`,
				`waterfall`.`alias`,
				`waterfall`.`introduction`,
				`waterfall`.`description`,
                `waterfall`.`album`,
				`waterfall`.`body`,
				`waterfall`.`directions`,
				`waterfall`.`rating`,
				`waterfall`.`height`,
				`waterfall`.`drop_height`,
				`waterfall`.`drop_count`,
				`waterfall`.`width`,
                `waterfall`.`nearest_town`,
				`county`.`name` AS `county`,
				`county`.`alias` AS `county_alias`,
				`county`.`title` AS `county_title`,
				`watercourse`.`name` AS `watercourse`,
				`watercourse`.`alias` AS `watercourse_alias`,
				`photo`.`name` AS `photo`,
				`photo_category`.`name` AS `photo_category`,
				`photo`.`description` AS `photo_description`,
				`coordinate`.`latitude`,
				`coordinate`.`longitude`,
				`coordinate`.`elevation`
			FROM
				`jpemeric_waterfall`.`waterfall`
					INNER JOIN
						`jpemeric_waterfall`.`watercourse`
							ON `watercourse`.`id` = `waterfall`.`watercourse`
					INNER JOIN
						`jpemeric_waterfall`.`county`
							ON `county`.`id` = `waterfall`.`county`
					LEFT JOIN (
						`jpemeric_image`.`photo`
							INNER JOIN
								`jpemeric_image`.`photo_category`
									ON `photo_category`.`id` = `photo`.`category`
						) ON `photo`.`id` = `waterfall`.`image`
					INNER JOIN
						`jpemeric_geodata`.`coordinate`
							ON `coordinate`.`id` = `waterfall`.`location`
			WHERE
				`waterfall`.`alias` = '{$waterfall}' &&
				`watercourse`.`alias` = '{$watercourse}' &&
				`waterfall`.`is_public` = '1'
			LIMIT 1";
		
		return self::run_row_query($query);
	}

}
