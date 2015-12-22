<?

Loader::load('collector', 'Collector');

final class CommentCollector extends Collector
{

	public static function getCommenterByFields($name, $email, $website)
	{
		$name = self::escape($name);
		$email = self::escape($email);
		$website = self::escape($website);
		
		$query = "
			SELECT
				*
			FROM
				`jpemeric_comment`.`commenter`
			WHERE
				`name` = '{$name}' &&
				`email` = '{$email}' &&
				`url` = '{$website}'
			LIMIT 1";
		
		return self::run_row_query($query);
	}

	public static function getCommentByBody($body)
	{
		$body = self::escape($body);
		
		$query = "
			SELECT
				*
			FROM
				`jpemeric_comment`.`comment`
			WHERE
				`body` = '{$body}'
			LIMIT 1";
		
		return self::run_row_query($query);
	}

	public static function getCommentPageByURL($path, $site)
	{
		$path = self::escape($path);
		
		$query = "
			SELECT
				*
			FROM
				`jpemeric_comment`.`comment_page`
			WHERE
				`site` = '{$site}' &&
				`path` = '{$path}'
			LIMIT
				1";
		
		return self::run_row_query($query);
	}

	public static function getNotificationForPage($comment_page)
	{
		$query = "
			SELECT
				`name`,
				`email`
			FROM
				`jpemeric_comment`.`commenter`
					INNER JOIN
						`jpemeric_comment`.`comment_meta` ON
							`comment_meta`.`commenter` = `commenter`.`id` &&
							`comment_meta`.`comment_page` = '{$comment_page}' &&
							`comment_meta`.`notify` = '1' &&
							`comment_meta`.`display` = '1'
			WHERE
				`commenter`.`trusted` = '1'
			GROUP BY
				`email`
			ORDER BY
				`date` DESC";
		
		return self::run_query($query);
	}

	public static function getRecentBlogComments($count)
	{
		$query = "
			SELECT
				`comment_meta`.`id`,
				`post`.`category`,
				`post`.`path`,
				`comment`.`body`,
				`commenter`.`name`
			FROM
				`jpemeric_comment`.`comment_meta`
					INNER JOIN `jpemeric_comment`.`comment` ON
						`comment`.`id` = `comment_meta`.`comment`
					INNER JOIN `jpemeric_comment`.`commenter` ON
						`commenter`.`id` = `comment_meta`.`commenter` AND
						`commenter`.`trusted` = '1'
					INNER JOIN `jpemeric_comment`.`comment_page` ON
						`comment_page`.`id` = `comment_meta`.`comment_page` AND
						`comment_page`.`site` = '2'
					INNER JOIN `jpemeric_blog`.`post` ON
						`post`.`path` = `comment_page`.`path` AND
						`post`.`display` = '1'
			WHERE
				`comment_meta`.`display` = '1'
			ORDER BY
				`comment_meta`.`date` DESC
			LIMIT {$count}";
		
		return self::run_query($query);
	}

    public static function getRecentWaterfallComments($count = 5)
    {
        $query = "
            SELECT
                `comment_meta`.`id`,
                CONCAT('journal/', `log`.`alias`) AS `log_path`,
                `log`.`title` AS `log_title`,
                `waterfall_join`.`alias` AS `waterfall_path`,
                `waterfall_join`.`name` AS `waterfall_title`,
                `comment`.`body`,
                `commenter`.`name`
            FROM
                `jpemeric_comment`.`comment_meta`
                    INNER JOIN `jpemeric_comment`.`comment` ON
                        `comment`.`id` = `comment_meta`.`comment`
                    INNER JOIN `jpemeric_comment`.`commenter` ON
                        `commenter`.`id` = `comment_meta`.`commenter` AND
                        `commenter`.`trusted` = '1'
                    INNER JOIN `jpemeric_comment`.`comment_page` ON
                        `comment_page`.`id` = `comment_meta`.`comment_page` AND
                        `comment_page`.`site` = '5'
                    LEFT JOIN `jpemeric_waterfall`.`log` ON
                        `log`.`alias` = `comment_page`.`path` AND
                        `log`.`is_public` = '1'
                    LEFT JOIN (
                        SELECT
                            CONCAT(`watercourse`.`alias`, '/', `waterfall`.`alias`) AS `alias`,
                            `waterfall`.`name`
                        FROM
                            `jpemeric_waterfall`.`waterfall`
                                INNER JOIN `jpemeric_waterfall`.`watercourse` ON
                                    `watercourse`.`id` = `waterfall`.`watercourse`
                        WHERE
                            `waterfall`.`is_public` = '1'
                        ) AS `waterfall_join` ON
                        `waterfall_join`.`alias` = `comment_page`.`path`
            WHERE
                `comment_meta`.`display` = '1'
            ORDER BY
                `comment_meta`.`date` DESC
            LIMIT {$count}";
        
        return self::run_query($query);
    }

	public static function getCommentsForURL($site, $path, $commenter = 0)
	{
		$path = self::escape($path);
		
		if($commenter != 0)
			$trusted_commenter_clause = "(`commenter`.`trusted` = '1' || `commenter`.`id` = '{$commenter}')";
		else
			$trusted_commenter_clause = "`commenter`.`trusted` = '1'";
		
		$query = "
			SELECT
				`comment_meta`.`id`,
				`comment_meta`.`reply`,
				`comment_meta`.`date`,
				`commenter`.`name`,
				`commenter`.`url`,
				`commenter`.`trusted`,
				`comment`.`body`,
				`comment`.`body_format`
			FROM
				`jpemeric_comment`.`comment_meta`
					INNER JOIN `jpemeric_comment`.`comment` ON
						`comment`.`id` = `comment_meta`.`comment`
					INNER JOIN `jpemeric_comment`.`commenter` ON
						`commenter`.`id` = `comment_meta`.`commenter` AND
						{$trusted_commenter_clause}
					INNER JOIN `jpemeric_comment`.`comment_page` ON
						`comment_page`.`id` = `comment_meta`.`comment_page` AND
						`comment_page`.`path` = '{$path}' AND
						`comment_page`.`site` = '{$site}'
			WHERE
				`comment_meta`.`display` = '1'
			ORDER BY
				`comment_meta`.`date`";
		
		return self::run_query($query);
	}

	public static function getCommentCountForURL($site, $path)
	{
		$path = self::escape($path);
		
		$query = "
			SELECT
				COUNT(1) AS `count`
			FROM
				`jpemeric_comment`.`comment_meta`
					INNER JOIN `jpemeric_comment`.`comment_page` ON
						`comment_page`.`id` = `comment_meta`.`comment_page` AND
						`comment_page`.`site` = '{$site}' AND
						`comment_page`.`path` = '{$path}'
					INNER JOIN `jpemeric_comment`.`commenter` ON
						`commenter`.`id` = `comment_meta`.`commenter` AND
						`commenter`.`trusted` = '1'
			WHERE
				`comment_meta`.`display` = '1'
			ORDER BY
				`comment_meta`.`date`";
		
		return self::get_count($query);
	}

}