<?

Loader::load('collector', 'Collector');

final class TagCollector extends Collector
{

	public static function getTagCloudGroup()
	{
		$query = "SELECT COUNT(1) AS `tag_count`,`tag` FROM `jpemeric_blog`.`tag`,`jpemeric_blog`.`post`,`jpemeric_blog`.`ptlink` WHERE `post`.`display` = 1 && `post`.`id` = `ptlink`.`post_id` && `tag`.`id` = `ptlink`.`tag_id` GROUP BY `tag`";
		return self::run_query($query);
	}

	public static function getTagsForPost($post_id)
	{
		$query = "SELECT * FROM `jpemeric_blog`.`tag`, `jpemeric_blog`.`ptlink` WHERE `tag`.`id` = `tag_id` && `post_id` = '{$post_id}' ORDER BY `tag`";
		return self::run_query($query);
	}

	public static function getSingleTag($tag)
	{
		$tag = self::escape($tag);
		$query = "SELECT * FROM `jpemeric_blog`.`tag` WHERE `tag` = '{$tag}' LIMIT 1";
		return self::run_row_query($query);
	}

	public static function getAllTags()
	{
		$query = "SELECT * FROM `jpemeric_blog`.`tag` ORDER BY `tag`";
		return self::run_query($query);
	}

}