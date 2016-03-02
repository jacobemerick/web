<?

Loader::load('controller', 'blog/DefaultListController');

final class CategoryController extends DefaultListController
{

	private static $TITLE_MAIN_HIKING = "Hiking | Posts on Upper Peninsula Exploring on Jacob Emerick's Blog";
	private static $DESCRIPTION_MAIN_HIKING = "Posts on Jacob Emerick's Blog about hiking the Upper Peninsula, exploring the Huron Mountains, and hunting waterfalls in the Keweenaw.";

	private static $TITLE_MAIN_PERSONAL = "Personal | Posts about life changes on Jacob Emerick's Blog";
	private static $DESCRIPTION_MAIN_PERSONAL = "Stories about life changes for Jacob and Katie. New jobs, getting married, and general thoughts on things.";

	private static $TITLE_MAIN_WEBDEVELOPMENT = "Web Development | Tutorials and Best Practices on Jacob Emerick's Blog";
	private static $DESCRIPTION_MAIN_WEBDEVELOPMENT = "Variety of tutorials and advice on best practices on Jacob Emerick's Blog, with a focus on object-orientated PHP development and project management.";

	private static $TITLE_PAGINATED_HIKING = "Hiking - Page %d of %d | Jacob Emerick's Blog";
	private static $DESCRIPTION_PAGINATED_HIKING = "Page %d of %d about hiking on Jacob Emerick's Blog. Posts about hiking the Upper Peninsula, exploring the Huron Mountains, and hunting waterfalls of the Keweenaw.";

	private static $TITLE_PAGINATED_PERSONAL = "Personal - Page %d of %d | Jacob Emerick's Blog";
	private static $DESCRIPTION_PAGINATED_PERSONAL = "Page %d of %d of personal posts on Jacob Emerick's Blog about life changes and general musings.";

	private static $TITLE_PAGINATED_WEBDEVELOPMENT = "Web Development - Page %d of %d | Jacob Emerick's Blog";
	private static $DESCRIPTION_PAGINATED_WEBDEVELOPMENT = "Page %d of %d of posts on web development, ranging from general tutorials to advanced best practices, on Jacob Emerick's Blog.";

	private static $KEYWORD_ARRAY_HIKING = array(
		'hiking',
		'upper peninsula',
		'huron mountains',
		'keweenaw',
		'michigan',
		'backpacking',
		'Jacob Emerick');

	private static $KEYWORD_ARRAY_PERSONAL = array(
		'dealerfire',
		'sparknet',
		'katie',
		'logan',
		'marriage',
		'Jacob Emerick');

	private static $KEYWORD_ARRAY_WEBDEVELOPMENT = array(
		'best practices',
		'object orientated php',
		'data abstraction',
		'semantic web',
		'responsive design',
		'responsible development',
		'Jacob Emerick');

	private $category;

	private static $LIST_DESCRIPTION = 'Viewing %d - %d of %d posts in the %s category.';

	public function __construct()
	{
		$url = URLDecode::getPiece(1);
		$this->category = (object) array(
			'display' => ucwords(str_replace('-', ' ', $url)),
			'link' => $url);
		
		parent::__construct();
	}

	protected function set_head_data()
	{
		parent::set_head_data();
		
		switch($this->category->display)
		{
			case 'Hiking' :
				if($this->page == 1)
				{
					$this->set_title(self::$TITLE_MAIN_HIKING);
					$this->set_description(self::$DESCRIPTION_MAIN_HIKING);
				}
				else
				{
					$this->set_title(sprintf(self::$TITLE_PAGINATED_HIKING, $this->page, $this->total_pages));
					$this->set_description(sprintf(self::$DESCRIPTION_PAGINATED_HIKING, $this->page, $this->total_pages));
				}
				$this->set_keywords(self::$KEYWORD_ARRAY_HIKING);
			break;
			case 'Personal' :
				if($this->page == 1)
				{
					$this->set_title(self::$TITLE_MAIN_PERSONAL);
					$this->set_description(self::$DESCRIPTION_MAIN_PERSONAL);
				}
				else
				{
					$this->set_title(sprintf(self::$TITLE_PAGINATED_PERSONAL, $this->page, $this->total_pages));
					$this->set_description(sprintf(self::$DESCRIPTION_PAGINATED_PERSONAL, $this->page, $this->total_pages));
				}
				$this->set_keywords(self::$KEYWORD_ARRAY_PERSONAL);
			break;
			case 'Web Development' :
				if($this->page == 1)
				{
					$this->set_title(self::$TITLE_MAIN_WEBDEVELOPMENT);
					$this->set_description(self::$DESCRIPTION_MAIN_WEBDEVELOPMENT);
				}
				else
				{
					$this->set_title(sprintf(self::$TITLE_PAGINATED_WEBDEVELOPMENT, $this->page, $this->total_pages));
					$this->set_description(sprintf(self::$DESCRIPTION_PAGINATED_WEBDEVELOPMENT, $this->page, $this->total_pages));
				}
				$this->set_keywords(self::$KEYWORD_ARRAY_WEBDEVELOPMENT);
			break;
		}
	}

	protected function get_introduction()
	{
		if($this->page == 1)
		{
        global $container;
        $repository = new Jacobemerick\Web\Domain\Blog\Introduction\MysqlIntroductionRepository($container['db_connection_locator']);
        $introduction_result = $repository->findByType('category', $this->category->link);
			
			$introduction = array();
			$introduction['title'] = $introduction_result['title'];
			$introduction['content'] = $introduction_result['content'];
			$introduction['image'] = $this->get_introduction_image($introduction_result['image']);
			
			return $introduction;
		}
		
		return array(
			'title' => "Posts about {$this->category->display}, page {$this->page} of {$this->total_pages}.");
	}

	protected function get_page_number()
	{
		$page = URLDecode::getPiece(2);
		if(isset($page) && is_numeric($page))
			return $page;
		return 1;
	}

	protected function get_list_results()
	{
        global $container;
        $repository = new Jacobemerick\Web\Domain\Blog\Post\MysqlPostRepository($container['db_connection_locator']);
        return $repository->getActivePostsByCategory($this->category->link, self::$POSTS_PER_PAGE, $this->offset);
	}

	protected function get_list_description()
	{
		$start = $this->offset + 1;
		$end = min($this->offset + self::$POSTS_PER_PAGE, $this->get_total_post_count());
		
		return sprintf(self::$LIST_DESCRIPTION, $start, $end, $this->get_total_post_count(), $this->category->display);
	}

	protected function get_list_next_link()
	{
		if($this->page == 1)
			return;
		if($this->page == 2)
			return Content::instance('URLSafe', "/{$this->category->link}/")->activate();
		return Content::instance('URLSafe', "/{$this->category->link}/" . ($this->page - 1) . '/')->activate();
	}

	protected function get_list_prev_link()
	{
		if(($this->page * self::$POSTS_PER_PAGE) >= $this->get_total_post_count())
			return;
		return Content::instance('URLSafe', "/{$this->category->link}/" . ($this->page + 1) . '/')->activate();
	}

	private $total_post_count;
	protected function get_total_post_count()
	{
		if(!isset($this->total_post_count)) {
        global $container;
        $repository = new Jacobemerick\Web\Domain\Blog\Post\MysqlPostRepository($container['db_connection_locator']);
        $this->total_post_count = $repository->getActivePostsCountByCategory($this->category->link);
    }
		return $this->total_post_count;
	}

}
