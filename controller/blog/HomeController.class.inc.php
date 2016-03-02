<?

Loader::load('controller', 'blog/DefaultListController');

final class HomeController extends DefaultListController
{

	private static $TITLE_MAIN = "Jacob Emerick's Blog | Posts on Hiking, Web Development, and more";
	private static $TITLE_PAGINATED = "Page %d of %d in Jacob Emerick's Blog";

	private static $DESCRIPTION_MAIN = "Jacob Emerick's Blog - a collection of posts about hiking the Upper Peninsula, learning to be a web developer, and other experiences of a young man.";
	private static $DESCRIPTION_PAGINATED = "Page %d of %d of posts about hiking in the Upper Peninsula, learning to be a web developer, and more on Jacob Emerick's Blog.";

	private static $KEYWORD_ARRAY = array(
		'blog',
		'Jacob Emerick',
		'hiking',
		'Huron Mountains',
		'Peshekee Highlands',
		'Keweenaw',
		'Michigan',
		'Upper Peninsula',
		'leadership',
		'web development',
		'php programming',
		'data handling',
		'optimization');

	private static $LIST_DESCRIPTION = 'Viewing %d - %d of %d total posts.';

	protected function set_head_data()
	{
		parent::set_head_data();
		
		if($this->page == 1)
			$this->set_title(self::$TITLE_MAIN);
		else
			$this->set_title(sprintf(self::$TITLE_PAGINATED, $this->page, $this->total_pages));
		
		if($this->page == 1)
			$this->set_description(self::$DESCRIPTION_MAIN);
		else
			$this->set_description(sprintf(self::$DESCRIPTION_PAGINATED, $this->page, $this->total_pages));
		
		$this->set_keywords(self::$KEYWORD_ARRAY);
	}

	protected function get_introduction()
	{
		if($this->page == 1)
		{
        global $container;
        $repository = new Jacobemerick\Web\Domain\Blog\Introduction\MysqlIntroductionRepository($container['db_connection_locator']);
        $introduction_result = $repository->findByType('home');
			
			$introduction = array();
			$introduction['title'] = $introduction_result['title'];
			$introduction['content'] = $introduction_result['content'];
			$introduction['image'] = $this->get_introduction_image($introduction_result['image']);
			
			return $introduction;
		}
		
		return array(
			'title' => "All of Jacob Emerick's posts, page {$this->page} of {$this->total_pages}.");
	}

	protected function get_page_number()
	{
		$page = URLDecode::getPiece(1);
		if(isset($page) && is_numeric($page))
			return $page;
		return 1;
	}

	protected function get_list_results()
	{
        global $container;
        $repository = new Jacobemerick\Web\Domain\Blog\Post\MysqlPostRepository($container['db_connection_locator']);
        return $repository->getActivePosts(self::$POSTS_PER_PAGE, $this->offset);
	}

	protected function get_list_description()
	{
		$start = $this->offset + 1;
		$end = min($this->offset + self::$POSTS_PER_PAGE, $this->get_total_post_count());
		
		return sprintf(self::$LIST_DESCRIPTION, $start, $end, $this->get_total_post_count());
	}

	protected function get_list_next_link()
	{
		if($this->page == 1)
			return;
		if($this->page == 2)
			return '/';
		return '/' . ($this->page - 1) . '/';
	}

	protected function get_list_prev_link()
	{
		if(($this->page * self::$POSTS_PER_PAGE) >= $this->get_total_post_count())
			return;
		return '/' . ($this->page + 1) . '/';
	}

	private $total_post_count;
	protected function get_total_post_count()
	{
      if(!isset($this->total_post_count)) {
          global $container;
          $repository = new Jacobemerick\Web\Domain\Blog\Post\MysqlPostRepository($container['db_connection_locator']);
          $this->total_post_count = $repository->getActivePostsCount();
      }

		return $this->total_post_count;
	}

}
