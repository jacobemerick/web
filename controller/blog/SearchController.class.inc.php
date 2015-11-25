<?

Loader::load('controller', 'blog/DefaultListController');
Loader::load('utility', 'Search');

final class SearchController extends DefaultListController
{

	private static $TITLE_MAIN = "%s Search | Jacob Emerick's Blog";
	private static $DESCRIPTION_MAIN = "Posts containing the phrase %s on Jacob Emerick's Blog.";

	private static $TITLE_PAGINATED = "%s Search - Page %d of %d | Jacob Emerick's Blog";
	private static $DESCRIPTION_PAGINATED = "Page %d of %d with posts containing the phrase %s on Jacob Emerick's Blog.";

	private static $KEYWORD_ARRAY = array(
		'hiking',
		'web development',
		'blog',
		'Jacob Emerick');

	private static $MAXIMUM_SEARCH_POSTS = 500;
	private static $LIST_DESCRIPTION = 'Viewing %d - %d of %d posts containing the phrase %s.';
	private static $SEARCH_WEIGHTS = array(
		array(
			'field' => 'title',
			'weight' => 8),
		array(
			'field' => 'body',
			'weight' => 4));

	private $query;

	public function __construct()
	{
		$query = URLDecode::getPiece(2);
		$query = urldecode($query);
        $query = str_replace('-', ' ', $query);
		
		$this->query = $query;
		
		parent::__construct();
	}

	protected function set_head_data()
	{
		parent::set_head_data();
		
		if($this->page == 1)
		{
			$this->set_title(sprintf(self::$TITLE_MAIN, ucwords($this->query)));
			$this->set_description(sprintf(self::$DESCRIPTION_MAIN, ucwords($this->query)));
		}
		else
		{
			$this->set_title(sprintf(self::$TITLE_PAGINATED, ucwords($this->query), $this->page, $this->total_pages));
			$this->set_description(sprintf(self::$DESCRIPTION_PAGINATED, $this->page, $this->total_pages, ucwords($this->query)));
		}
		
		$keyword_array = self::$KEYWORD_ARRAY;
		array_unshift($keyword_array, $this->query);
		$this->set_keywords($keyword_array);
	}

	protected function get_introduction()
	{
		if($this->total_pages > 1)
			return array(
				'title' => "Posts from search '{$this->query}', page {$this->page} of {$this->total_pages}.");
		else if($this->total_pages == 1)
			return array(
				'title' => "Posts from search '{$this->query}'.");
		else
			return array(
				'title' => "Sorry, '{$this->query}' didn't return any posts.");
	}

	protected function get_page_number()
	{
		$page = URLDecode::getPiece(3);
		if(isset($page) && is_numeric($page))
			return $page;
		return 1;
	}

	private $search_result;
	private function get_search_result()
	{
		if(!isset($this->search_result))
		{
			$posts = PostCollector::getMainList(self::$MAXIMUM_SEARCH_POSTS);
			
			$this->search_result = Search::instance()
				->setQuery($this->query)
				->setResult($posts)
				->setWeight(self::$SEARCH_WEIGHTS)
				->perform();
		}
		return $this->search_result;
	}

	protected function get_list_results()
	{
		return array_slice($this->get_search_result(), $this->offset, self::$POSTS_PER_PAGE);
	}

	protected function get_list_description()
	{
		$start = $this->offset + 1;
		$end = min($this->offset + self::$POSTS_PER_PAGE, $this->get_total_post_count());
		
		return sprintf(self::$LIST_DESCRIPTION, $start, $end, $this->get_total_post_count(), $this->query);
	}

	protected function get_list_next_link()
	{
		if($this->page == 1)
			return;
		if($this->page == 2)
			return Content::instance('URLSafe', "/search/{$this->query}/")->activate();
		return Content::instance('URLSafe', "/search/{$this->query}/" . ($this->page - 1) . '/')->activate();
	}

	protected function get_list_prev_link()
	{
		if(($this->page * self::$POSTS_PER_PAGE) >= $this->get_total_post_count())
			return;
		return Content::instance('URLSafe', "/search/{$this->query}/" . ($this->page + 1) . '/')->activate();
	}

	private $total_post_count;
	protected function get_total_post_count()
	{
		if(!isset($this->total_post_count))
			$this->total_post_count = count($this->get_search_result());
		return $this->total_post_count;
	}

}