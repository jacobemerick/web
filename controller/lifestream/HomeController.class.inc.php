<?

Loader::load('controller', 'lifestream/DefaultListController');

final class HomeController extends DefaultListController
{

	private static $TITLE = "Jacob Emerick's Lifestream";
	private static $DESCRIPTION = 'Lifestream for Jacob Emerick, a combination of his latest twitter, youtube, running, reading, and blogging activity.';

	private static $KEYWORD_ARRAY = array(
		'lifestream',
		'activity stream',
		'Jacob Emerick',
		'jacobemerick',
		'jpemeric',
		'twitter');

	private static $LIST_DESCRIPTION = 'viewing %d - %d of %d total activities';

	protected function set_head_data()
	{
		$this->set_title(self::$TITLE);
		$this->set_description(self::$DESCRIPTION);
		$this->set_keywords(self::$KEYWORD_ARRAY);
		
		parent::set_head_data();
	}

	protected function set_body_data()
	{
		$this->set_body('title', "What's Jacob Up To?");
		$this->set_body('description', "A combination of Jacob Emerick's tweets, runs, reads, blogs, and YouTubes all in <em>one awesome lifestream</em>.");
		
		parent::set_body_data();
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
    return $this->postRepository->getPosts(self::$POSTS_PER_PAGE, $this->offset);
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
			return Loader::getRootUrl('lifestream');
		return Loader::getRootUrl('lifestream') . 'page/' . ($this->page - 1) . '/';
	}

	protected function get_list_prev_link()
	{
		if(($this->page * self::$POSTS_PER_PAGE) >= $this->get_total_post_count())
			return;
		return Loader::getRootUrl('lifestream') . 'page/' . ($this->page + 1) . '/';
	}

	private $total_post_count;
	protected function get_total_post_count()
	{
		if(!isset($this->total_post_count))
			$this->total_post_count = $this->postRepository->getPostsCount();
		return $this->total_post_count;
	}

}
