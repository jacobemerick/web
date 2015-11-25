<?

Loader::load('collector', 'Collector');

final class SeriesCollector extends Collector
{

	public static function getSeriesForPost($post)
	{
		$query = "
			SELECT
				`post`.`id` AS post,
				`post`.`title`,
				`post`.`category`,
				`post`.`path`,
				`series`.`title` AS `series_title`,
				`series`.`description`
			FROM
				`jpemeric_blog`.`series`,
				`jpemeric_blog`.`series_post`,
				`jpemeric_blog`.`post`
			WHERE
				`series`.`id` = `series_post`.`series` &&
				`post`.`id` = `series_post`.`post` &&
				`post`.`display` = '1' &&
				`series`.`id` = (
					SELECT
						`series`
					FROM
						`jpemeric_blog`.`series_post`
					WHERE
						`post` = '{$post}')
			ORDER BY
				`series_post`.`order`";
		return self::run_query($query);
	}

}