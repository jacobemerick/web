<?

Loader::load('controller', 'blog/DefaultPageController');

abstract class DefaultListController extends DefaultPageController
{

	protected static $POSTS_PER_PAGE = 10;

	protected $page;
	protected $offset;

	public function __construct()
	{
		parent::__construct();
		
		$this->page = $this->get_page_number();
		$this->total_pages = ceil($this->get_total_post_count() / self::$POSTS_PER_PAGE);
		$this->offset = ($this->page - 1) * self::$POSTS_PER_PAGE;
	}

	abstract protected function get_page_number();
	abstract protected function get_list_results();
	abstract protected function get_list_description();
	abstract protected function get_list_next_link();
	abstract protected function get_list_prev_link();
	abstract protected function get_total_post_count();

	protected function set_head_data()
	{
		parent::set_head_data();
		
		$this->set_head('next_link', $this->get_list_next_link());
		$this->set_head('previous_link', $this->get_list_prev_link());
	}

	protected function set_body_data()
	{
		parent::set_body_data();
		
		$this->set_body('view', 'Listing');
		$this->set_body('data', $this->get_list_body_data());
	}

	final private function get_list_body_data()
	{
		return array(
			'posts' => $this->get_list_posts(),
			'show_top_navigation' => ($this->page !== 1),
			'navigation' => array(
				'description' => $this->get_list_description(),
				'next' => $this->get_list_next_link(),
				'prev' => $this->get_list_prev_link()));
	}

	final private function get_list_posts()
	{
		$post_array = array();
		foreach($this->get_list_results() as $post)
		{
			$post_array[] = $this->format_post($post, true);
		}
		if(count($post_array) < 1 && URLDecode::getPiece(1) !== 'search')
			$this->eject();
		return $post_array;
	}

}