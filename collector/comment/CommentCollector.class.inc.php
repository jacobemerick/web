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
}
