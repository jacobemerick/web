<?

Loader::load('collector', 'waterfall/WaterfallCollector');
Loader::load('controller', 'waterfalls/DefaultWaterfallListController');

final class WatercourseListController extends DefaultWaterfallListController
{

	private static $DEFAULT_TITLE = 'Hiking with %s, Page %d of %d';
	private static $DEFAULT_DESCRIPTION = 'Page %d of %d of legendary hiking stories with %s written by Jacob Emerick, all about his adventures hunting waterfalls in the Upper Peninsula of Michigan';
	private static $DEFAULT_HEADER = 'Page %d of Legendary Hiking Stories with %s';

	private static $KEYWORD_ARRAY = array(
		'hiking companions',
		'journal',
		'stories',
		'blog',
		'waterfalls');

	private static $NAVIGATION_DESCRIPTION = 'displaying %d ~ %d of %d waterfalls in %COUNTY%';
	private static $LINK_ROOT = '/%s/';

	protected static $ITEM_COUNT_PER_PAGE = 12;

	private $watercourse;

	public function __construct()
	{
		$path = URLDecode::getPiece(1);
		$this->watercourse = WatercourseCollector::getByAlias($path);
		
		if(!$this->watercourse)
			$this->eject();
	
		parent::__construct();
	}

	protected function get_initial_meta()
	{
		$meta_array = array();
		
		$meta_array['title'] = "{$this->watercourse->name} | " . self::$WEBSITE_TITLE;
		$meta_array['description'] = $this->watercourse->description;
		$meta_array['keywords'] = $this->get_keyword_array();
		
		return $meta_array;
	}

	protected function get_subsequent_meta()
	{
		$meta_array = array();
		
		$meta_array['title'] = sprintf(self::$DEFAULT_TITLE . ' | ' . self::$WEBSITE_TITLE, $this->watercourse->name, $this->page, $this->page_count);
		$meta_array['description'] = sprintf(self::$DEFAULT_DESCRIPTION, $this->page, $this->page_count, $this->watercourse->name);
		$meta_array['keywords'] = $this->get_keyword_array();
		
		return $meta_array;
	}

	private function get_keyword_array()
	{
		$keyword_array = self::$KEYWORD_ARRAY;
		array_unshift($keyword_array, strtolower($this->watercourse->name));
		return $keyword_array;
	}

	protected function get_initial_introduction()
	{
		$introduction = array();
		
		$introduction['title'] = $this->watercourse->header;
		$introduction['description'] = Content::instance('FixInternalLink', $this->watercourse->introduction)->activate();
		$introduction['image'] = $this->get_image_element($this->watercourse->photo_category, $this->watercourse->photo, $this->watercourse->photo_description, 'medium');
		
		return $introduction;
	}

	protected function get_subsequent_introduction()
	{
		return array(
			'title' => sprintf(self::$DEFAULT_HEADER, $this->page, $this->watercourse->name));
	}

	protected function get_item_count_per_page()
	{
		return self::$ITEM_COUNT_PER_PAGE;
	}

	protected function get_page_number_piece()
	{
		return URLDecode::getPiece(2);
	}

	protected function get_item_result($total, $offset)
	{
		return WatercourseCollector::getLogListForWatercourse($this->watercourse->id, $total, $offset);
	}

	protected function get_item_count_result()
	{
		return WatercourseCollector::getLogCountForWatercourse($this->watercourse->id);
	}

	protected function get_list_description_pattern()
	{
		return str_replace('%COUNTY%', $this->watercourse->name, self::$NAVIGATION_DESCRIPTION);
	}

	protected function get_list_link_root()
	{
		return sprintf(self::$LINK_ROOT, $this->watercourse->alias);
	}

}