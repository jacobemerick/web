<?

Loader::load('controller', 'lifestream/DefaultListController');

final class TagController extends DefaultListController
{

	private static $TITLE = "%s Activity | Jacob Emerick's Lifestream";
	private static $DESCRIPTION = "%s activity on Jacob Emerick's lifestream, all nice and paginated in one awesome website.";

	private static $KEYWORD_ARRAY = array(
		'lifestream',
		'activity stream',
		'Jacob Emerick');

	private static $LIST_DESCRIPTION = 'viewing %d - %d of %d %s activities';

	private $tag;

	public function __construct()
	{
		parent::__construct();
		
		$this->tag = URLDecode::getPiece(1);
	}

	protected function set_head_data()
	{
		$this->set_title(sprintf(self::$TITLE, ucwords($this->tag)));
		$this->set_description(sprintf(self::$DESCRIPTION, ucwords($this->tag)));
		
		$keyword_array = self::$KEYWORD_ARRAY;
		array_unshift($keyword_array, $this->tag);
		$this->set_keywords($keyword_array);
		
		parent::set_head_data();
	}

	protected function set_body_data()
	{
		$this->set_body('title', $this->get_title());
		$this->set_body('description', $this->get_description());
		
		parent::set_body_data();
	}

	private function get_title()
	{
		switch($this->tag)
		{
			case 'blog' :
				return 'Jacob has a Blog';
			break;
			case 'book' :
				return 'Jacob reads Books';
			break;
			case 'distance' :
				return 'Run, Jacob, and Hike';
			break;
			case 'hulu' :
				return 'Jacob watches Hulu';
			break;
			case 'twitter' :
				return 'Jacob likes to Tweet';
			break;
			case 'youtube' :
				return 'Videos Jacob Likes';
			break;
		}
	}

	private function get_description()
	{
		switch($this->tag)
		{
			case 'blog' :
				return 'Yeah, Jacob has a blog. Check out his posting activity.';
			break;
			case 'book' :
				return "Outside of building websites, hiking, and <em>being awesome</em>, Jacob reads books. Check out what he's been reading.";
			break;
			case 'distance' :
				return 'All the cool kids like to be in shape. Jacob goes running and hiking.';
			break;
			case 'hulu' :
				return 'Occasionally Jacob chills and watches some Hulu. Well, used to, anyways.';
			break;
			case 'twitter' :
				return 'All the cool kids are on Twitter. The cool kids and Jacob. Check his tweets, yo.';
			break;
			case 'youtube' :
				return 'Jacob watches videos on YouTube. Some videos he likes more than others.';
			break;
		}
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
		return ActivityCollector::getByTagInRange($this->tag, self::$POSTS_PER_PAGE, $this->offset);
	}

	protected function get_list_description()
	{
		$start = $this->offset + 1;
		$end = min($this->offset + self::$POSTS_PER_PAGE, $this->get_total_post_count());
		
		return sprintf(self::$LIST_DESCRIPTION, $start, $end, $this->get_total_post_count(), $this->tag);
	}

	protected function get_list_next_link()
	{
		if($this->page == 1)
			return;
		if($this->page == 2)
			return Loader::getRootUrl('lifestream') . $this->tag . '/';
		return Loader::getRootUrl('lifestream') . $this->tag . '/page/' . ($this->page - 1) . '/';
	}

	protected function get_list_prev_link()
	{
		if(($this->page * self::$POSTS_PER_PAGE) >= $this->get_total_post_count())
			return;
		return Loader::getRootUrl('lifestream') . $this->tag . '/page/' . ($this->page + 1) . '/';
	}

	private $total_post_count;
	protected function get_total_post_count()
	{
		if(!isset($this->total_post_count))
			$this->total_post_count = ActivityCollector::getCountForTag($this->tag);
		return $this->total_post_count;
	}

}