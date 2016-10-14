<?

Loader::load('collector', 'waterfall/LogCollector');
Loader::load('controller', 'blog/DefaultPageController');

final class PostController extends DefaultPageController
{

	private static $PAGE_DESCRIPTION_LIMIT = 250;

	private static $TITLE = "%s | Jacob Emerick's Blog";
	private static $AUTHOR = 'Jacob Emerick';
	private static $AUTHOR_URL = 'https://home.jacobemerick.com/';

	private static $POST_LENGTH_SHORT = 100;
	private static $POST_LENGTH_LONG = 140;

	private $post;
	private $tags;
	private $comment_errors = array();

	public function __construct()
	{
		parent::__construct();
		
        global $container;
        $repository = new Jacobemerick\Web\Domain\Blog\Post\MysqlPostRepository($container['db_connection_locator']);
        $this->post = $repository->findPostByPath(URLDecode::getPiece(2));

		if($this->post == null)
			$this->eject();
		
		$this->handle_comment_submit(
			self::$BLOG_SITE_ID,
			$this->post['path'],
			Loader::getRootUrl('blog') . $this->post['category'] . '/' . $this->post['path'] . '/',
			$this->post['title']);

        global $container;
        $repository = new Jacobemerick\Web\Domain\Blog\Tag\MysqlTagRepository($container['db_connection_locator']);
        $this->tags = $repository->getTagsForPost($this->post['id']);
	}

	protected function set_head_data()
	{
		parent::set_head_data();
		
		$this->set_title(sprintf(self::$TITLE, $this->post['title']));
		$this->set_description($this->get_post_description());
		$this->set_keywords($this->get_post_keywords());
		$this->set_author(self::$AUTHOR);

    $photo = Content::instance('FetchFirstPhoto', $this->post['body'])->activate(true);
    $photo = preg_match('/^<img src="([a-z-:\.\/]+)" [^>]+>$/', $photo, $matches);
    $this->set_head('thumbnail', $matches[1]);

		if (array_key_exists($this->post['id'], self::$DEPRECATED_BLOGS)) {
			$log_id = self::$DEPRECATED_BLOGS[$this->post['id']];
			$log = LogCollector::getById($log_id);
			if (!empty($log)) {
				$log_url = Loader::getRootUrl('waterfalls') . "journal/{$log->alias}/";
				$this->set_canonical($log_url);
			}
		}
	}

	protected function get_introduction() {}

	protected function set_body_data()
	{
		parent::set_body_data();
		
		$this->set_body('title', $this->post['title']);
		$this->set_body('view', 'Post');
		$this->set_body('data', array(
			'post' => $this->format_post($this->post, false),
			'series_posts' => $this->get_series_posts(),
			'related_posts' => $this->get_related_posts(),
			'author' => self::$AUTHOR,
			'author_url' => self::$AUTHOR_URL,
      'comment_array' => $this->get_comment_array(
          'blog.jacobemerick.com',
          "{$this->post['category']}/{$this->post['path']}"
      ),
    ));
	}

	protected function get_post_description()
	{
		$description = $this->post['body'];
		$description = strip_tags($description);
		$description = Content::instance('SmartTrim', $description)->activate(self::$PAGE_DESCRIPTION_LIMIT);
		
		return $description;
	}

	protected function get_post_keywords()
	{
		$keyword_array = array();
		$keywords = $this->tags;
		
		foreach($keywords as $keyword)
		{
			$keyword_array[] = $keyword['tag'];
		}
		
		$keyword_array[] = 'blog';
		$keyword_array[] = 'Jacob Emerick';
		
		return $keyword_array;
	}

	private function get_series_posts()
	{
		$series_posts = $this->fetch_series_posts();
		if(count($series_posts) < 1)
			return array();
		
		$previous_post = new stdclass();
		$next_post = new stdclass();
		
		$found_current_post = false;
		foreach($series_posts as $post_row)
		{
			if($post_row['post'] == $this->post['id'])
			{
				$found_current_post = true;
				continue;
			}
			
			$post = new stdclass();

      if (
        strpos($post_row['title'], 'Rainy Supe Loop') === 0 ||
        strpos($post_row['title'], 'Malapais Loop') === 0 ||
        strpos($post_row['title'], 'Mazatzal Peak Loop') === 0 ||
        strpos($post_row['title'], 'Dripping Springs Loop') === 0 ||
        strpos($post_row['title'], 'The Park of Mazatzals') === 0
      ) {
        $title = $post_row['title'];
        $title = explode(':', $title);
        $title = array_pop($title);
        $title = trim($title);
        $post->title = $title;
      } else if (strpos($post_row['title'], 'Isle Royale') === 0) {
				$title = $post_row['title'];
				$title = explode(',', $title);
				$title = array_pop($title);
				$title = trim($title);
				$post->title = $title;
			} else {
				$post->title = $post_row['title'];
			}

			$post->url = Loader::getRootUrl('blog') . "{$post_row['category']}/{$post_row['path']}/";
			
			if(!$found_current_post)
				$previous_post = $post;
			else
			{
				$next_post = $post;
				break;
			}
		}
		
		return array(
			'title' => $post_row['series_title'],
			'description' => Content::instance('FixInternalLink', $post_row['series_description'])->activate(),
			'previous' => $previous_post,
			'next' => $next_post);
	}

	private $series_posts;
	private function fetch_series_posts()
	{
      if(!isset($this->series_posts)) {
          global $container;
          $repository = new Jacobemerick\Web\Domain\Blog\Series\MysqlSeriesRepository($container['db_connection_locator']);
          $this->series_posts = $repository->getSeriesForPost($this->post['id']);
      }
      return $this->series_posts;
	}

	private function get_related_posts()
	{
		$tag_array = array();
		foreach($this->tags as $tag)
		{
			$tag_array[] = $tag['id'];
		}
		
		$series_posts = $this->fetch_series_posts();
		$exclude_post_array = array();
		foreach($series_posts as $series_post)
		{
			$exclude_post_array[] = $series_post['post'];
		}

        global $container;
        $repository = new Jacobemerick\Web\Domain\Blog\Post\MysqlPostRepository($container['db_connection_locator']);
        $post_result = $repository->getActivePostsByRelatedTags($this->post['id']);

        $post_array = array();
		
		foreach($post_result as $post_row)
		{
			$post = new stdclass();
			$post->title = $post_row['title'];
			$post->url = Loader::getRootUrl('blog') . "{$post_row['category']}/{$post_row['path']}/";
			$post->category = ucwords(str_replace('-', ' ', $post_row['category']));
			$post->thumb = Content::instance('FetchFirstPhoto', $post_row['body'])->activate();
			$post->body = Content::instance('SmartTrim', $post_row['body'])->activate(($post->thumb !== '') ? self::$POST_LENGTH_SHORT : self::$POST_LENGTH_LONG);
			
			$post_array[] = $post;
		}
		
		return $post_array;
	}
}
