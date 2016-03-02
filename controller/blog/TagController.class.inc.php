<?

Loader::load('controller', 'blog/DefaultListController');

final class TagController extends DefaultListController
{

	private static $TITLE_MAIN = "%s Tag | Jacob Emerick's Blog";
	private static $DESCRIPTION_MAIN = "Posts tagged with %s on Jacob Emerick's Blog, a website about Upper Peninsula hiking and web development best practices.";

	private static $TITLE_PAGINATED = "%s - Page %d of %d | Jacob Emerick's Blog";
	private static $DESCRIPTION_PAGINATED = "Page %d of %d with posts tagged with %s on Jacob Emerick's Blog, a website about the hiking and development adventures of a young man.";

	private static $KEYWORD_ARRAY = array(
		'hiking',
		'web development',
		'blog',
		'Jacob Emerick');

	private static $LIST_DESCRIPTION = 'Viewing %d - %d of %d posts tagged with %s.';

	private $tag;

	public function __construct()
	{
		$tag = URLDecode::getPiece(2);
		$tag = str_replace('-', ' ', $tag);

        global $container;
        $repository = new Jacobemerick\Web\Domain\Blog\Tag\MysqlTagRepository($container['db_connection_locator']);
        $tag_result = $repository->findTagByTitle($tag);

		if($tag_result === false)
			$this->eject();
		
		$this->tag = (object) $tag_result;
		
		parent::__construct();
	}

	protected function set_head_data()
	{
		parent::set_head_data();
		
		if($this->page == 1)
		{
			$this->set_title(sprintf(self::$TITLE_MAIN, ucwords($this->tag->tag)));
			$this->set_description(sprintf(self::$DESCRIPTION_MAIN, ucwords($this->tag->tag)));
		}
		else
		{
			$this->set_title(sprintf(self::$TITLE_PAGINATED, ucwords($this->tag->tag), $this->page, $this->total_pages));
			$this->set_description(sprintf(self::$DESCRIPTION_PAGINATED, $this->page, $this->total_pages, ucwords($this->tag->tag)));
		}
		
		$keyword_array = self::$KEYWORD_ARRAY;
		array_unshift($keyword_array, $this->tag->tag);
		$this->set_keywords($keyword_array);
	}

	protected function get_introduction()
	{
		$tag = ucwords($this->tag->tag);
		
		if($this->page == 1)
		{
        global $container;
        $repository = new Jacobemerick\Web\Domain\Blog\Introduction\MysqlIntroductionRepository($container['db_connection_locator']);
        $introduction_result = $repository->findByType('tag', $this->tag->tag);
			
			if($introduction_result !== null)
			{
				$introduction = array();
				$introduction['title'] = $introduction_result['title'];
				$introduction['content'] = $introduction_result['content'];
				$introduction['image'] = $this->get_introduction_image($introduction_result['image']);
				
				return $introduction;
			}
			
			return array(
				'title' => "Viewing posts about {$tag}.");
		}
		
		return array(
			'title' => "{$tag} posts, page {$this->page} of {$this->total_pages}.");
	}

	protected function get_page_number()
	{
		$page = URLDecode::getPiece(3);
		if(isset($page) && is_numeric($page))
			return $page;
		return 1;
	}

	protected function get_list_results()
	{
		return PostCollector::getPostsForTag($this->tag->id, self::$POSTS_PER_PAGE, $this->offset);
	}

	protected function get_list_description()
	{
		$start = $this->offset + 1;
		$end = min($this->offset + self::$POSTS_PER_PAGE, $this->get_total_post_count());
		
		return sprintf(self::$LIST_DESCRIPTION, $start, $end, $this->get_total_post_count(), $this->tag->tag);
	}

	protected function get_list_next_link()
	{
		if($this->page == 1)
			return;
		if($this->page == 2)
			return Content::instance('URLSafe', "/tag/{$this->tag->tag}/")->activate();
		return Content::instance('URLSafe', "/tag/{$this->tag->tag}/" . ($this->page - 1) . '/')->activate();
	}

	protected function get_list_prev_link()
	{
		if(($this->page * self::$POSTS_PER_PAGE) >= $this->get_total_post_count())
			return;
		return Content::instance('URLSafe', "/tag/{$this->tag->tag}/" . ($this->page + 1) . '/')->activate();
	}

	private $total_post_count;
	protected function get_total_post_count()
	{
		if(!isset($this->total_post_count))
			$this->total_post_count = PostCollector::getPostCountForTag($this->tag->id);
		return $this->total_post_count;
	}

}
