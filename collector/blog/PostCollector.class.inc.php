<?

Loader::load('collector', 'Collector');

final class PostCollector extends Collector
{

	public static function getPostedDates()
	{
		$query = "SELECT `date` FROM `jpemeric_blog`.`post` WHERE `display` = '1' ORDER BY `date` DESC";
		return self::run_query($query);
	}

	public static function getRecentPosts($total = 3)
	{
		$query = "SELECT `title`, `path`, `date`, `body`, `category` FROM `jpemeric_blog`.`post` WHERE `display` = '1' ORDER BY `date` DESC LIMIT 0, {$total}";
		return self::run_query($query);
	}

	public static function getMainList($total, $offset = 0)
	{
		$query = "SELECT `post`.`id` AS `id`, `title`, `path`, `date`, `body`, `category` FROM `jpemeric_blog`.`post` WHERE `display` = '1' ORDER BY `date` DESC LIMIT {$offset}, {$total}";
		return self::run_query($query);
	}

	public static function getMainPostCount()
	{
		$query = "SELECT COUNT(1) AS `count` FROM `jpemeric_blog`.`post` WHERE `display` = '1'";
		return self::get_count($query);
	}

	public static function getPostsForTag($tag_id, $total, $offset = 0)
	{
		$query = "SELECT `post`.`id` AS `id`, `title`, `path`, `date`, `body`, `category` FROM `jpemeric_blog`.`post`,`jpemeric_blog`.`ptlink` WHERE `display` = '1' && `post`.`id` = `ptlink`.`post_id` && `ptlink`.`tag_id` = '{$tag_id}' ORDER BY `date` DESC LIMIT {$offset}, {$total}";
		return self::run_query($query);
	}

	public static function getPostCountForTag($tag_id)
	{
		$query = "SELECT COUNT(1) AS `count` FROM `jpemeric_blog`.`post`, `jpemeric_blog`.`ptlink` WHERE `post`.`id` = `ptlink`.`post_id` && `ptlink`.`tag_id` = '{$tag_id}' && `display` = '1'";
		return self::get_count($query);
	}

	public static function getPostsForCategory($category, $total, $offset = 0)
	{
		$category = self::escape($category);
		$query = "SELECT `post`.`id` AS `id`, `title`, `path`, `date`, `body`, `category` FROM `jpemeric_blog`.`post` WHERE `display` = '1' && `category` = '{$category}' ORDER BY `date` DESC LIMIT {$offset}, {$total}";
		return self::run_query($query);
	}

	public static function getPostCountForCategory($category)
	{
		$category = self::escape($category);
		$query = "SELECT COUNT(1) AS `count` FROM `jpemeric_blog`.`post` WHERE `category` = '{$category}' && `display` = '1'";
		return self::get_count($query);
	}

	public static function getPostsForMonth($min_date, $max_date, $total, $offset = 0)
	{
		$query = "SELECT `post`.`id` AS `id`, `title`, `path`, `date`, `body`, `category` FROM `jpemeric_blog`.`post` WHERE `display` = '1' && `date` >= '{$min_date}' && `date` <= '{$max_date}' ORDER BY `date` DESC LIMIT {$offset}, {$total}";
		return self::run_query($query);
	}

	public static function getPostCountForMonth($min_date, $max_date)
	{
		$query = "SELECT COUNT(1) AS `count` FROM `jpemeric_blog`.`post` WHERE `date` >= '{$min_date}' && `date` <= '{$max_date}' && `display` = '1'";
		return self::get_count($query);
	}

	public static function getPostByURI($uri)
	{
		$uri = self::escape($uri);
		$query = "SELECT `post`.`id` AS `id`, `title`, `path`, `date`, `body`, `category` FROM `jpemeric_blog`.`post` WHERE `path` = '{$uri}' && `display` = '1' LIMIT 1";
		return self::run_row_query($query);
	}

	public static function getRelatedPosts($id, $tags, $exclude_posts = array(), $limit = 4)
	{
		$tag_clause = implode("', '", $tags);
		$tag_clause = "'{$tag_clause}'";
		
		$exclude_clause = '';
		if(count($exclude_posts) > 0)
		{
			$exclude_clause .= " && `ptlink`.`post_id` NOT IN ('";
			$exclude_clause .= implode("', '", $exclude_posts);
			$exclude_clause .= "')";
		}
		
		$query = "SELECT `title`, `path`, `category`, `body` FROM `jpemeric_blog`.`post`, `jpemeric_blog`.`ptlink` WHERE `ptlink`.`post_id` = `post`.`id` && `tag_id` IN ({$tag_clause}) && `post_id` <> '{$id}'{$exclude_clause} GROUP BY `post_id` ORDER BY COUNT(1) DESC LIMIT {$limit}";
		return self::run_query($query);
	}

}