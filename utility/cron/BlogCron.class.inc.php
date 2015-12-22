<?

Loader::load('collector', array(
	'blog/PostCollector',
	'comment/CommentCollector',
	'stream/BlogCollector'));
Loader::load('utility', 'cron/Cron');

final class BlogCron extends Cron
{

	private static $INSERT_NEW_QUERY = "INSERT INTO `jpemeric_stream`.`blog` (`title`,`category`,`url`,`body`,`comments`,`date`) VALUES ('%s','%s','%s','%s','%d','%s')";
	private static $UPDATE_COMMENTS_QUERY = "UPDATE `jpemeric_stream`.`blog` SET `comments` = '%d' WHERE `id` = '%d'";

	private $post_array = array();

	function __construct()
	{
		$post_array = PostCollector::getMainList(250);
		$this->post_array = $post_array;
	}

	public function activate()
	{
		foreach($this->post_array as $post)
		{
			$blog_result = BlogCollector::getBlogByTitle($post->title);
			if($blog_result !== null)
			{
				$comments = CommentCollector::getCommentCountForURL(2, $post->path);
				if($blog_result->comments != $comments)
				{
					$query = sprintf(self::$UPDATE_COMMENTS_QUERY, $comments, $blog_result->id);
					Database::execute($query);
				}
			}
			else
			{
				$title = Database::escape($post->title);
				$category = Database::escape($post->category);
				
				$url = '';
				$url .= Loader::getRootUrl('blog');
				$url .= "{$post->category}/";
				$url .= "{$post->path}/";
				
				$body = Database::escape($post->body);
				$comments = CommentCollector::getCommentCountForURL(2, $post->path);
				
				$date = '';
				$date .= $post->date;
				$date .= ' ';
				$date .= date('H:i:s');
				
				$query = sprintf(self::$INSERT_NEW_QUERY, $title, $category, $url, $body, $comments, $date);
				Database::execute($query);
			}
		}
		return true;
	}

}