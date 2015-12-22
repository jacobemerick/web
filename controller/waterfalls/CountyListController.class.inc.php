<?

Loader::load('collector', 'waterfall/CountyCollector');
Loader::load('controller', 'waterfalls/DefaultWaterfallListController');

final class CountyListController extends DefaultWaterfallListController
{

	private static $DEFAULT_TITLE = '%s Waterfalls, Page %d of %d';
	private static $DEFAULT_DESCRIPTION = 'Page %d of %d of awesome waterfalls in %s, located in the northwestern wilds of Micigan\'s Upper Peninsula.';
	private static $DEFAULT_HEADER = 'Page %d of Awesome %s Waterfalls';

	private static $KEYWORD_ARRAY = array(
		'upper peninsula',
		'michigan',
		'keweenaw',
		'waterfalls');

	private static $NAVIGATION_DESCRIPTION = 'displaying %d ~ %d of %d waterfalls in %COUNTY%';
	private static $LINK_ROOT = '/%s/';

	protected static $ITEM_COUNT_PER_PAGE = 12;

	private $county;

	public function __construct()
	{
		$path = URLDecode::getPiece(1);
		$this->county = CountyCollector::getByAlias($path);
		
		if(!$this->county)
			$this->eject();
		
		parent::__construct();
	}

	protected function get_initial_meta()
	{
		$meta_array = array();
		
		$meta_array['title'] = "{$this->county->name} Waterfalls | " . self::$WEBSITE_TITLE;
		$meta_array['description'] = $this->county->description;
		$meta_array['keywords'] = $this->get_keyword_array();
		
		return $meta_array;
	}

	protected function get_subsequent_meta()
	{
		$meta_array = array();
		
		$meta_array['title'] = sprintf(self::$DEFAULT_TITLE . ' | ' . self::$WEBSITE_TITLE, $this->county->name, $this->page, $this->page_count);
		$meta_array['description'] = sprintf(self::$DEFAULT_DESCRIPTION, $this->page, $this->page_count, $this->county->name);
		$meta_array['keywords'] = $this->get_keyword_array();
		
		return $meta_array;
	}

	private function get_keyword_array()
	{
		$keyword_array = self::$KEYWORD_ARRAY;
		array_unshift($keyword_array, strtolower($this->county->name));
		return $keyword_array;
	}

	protected function get_initial_introduction()
	{
		$introduction = array();
		
		$introduction['title'] = $this->county->title;
		$introduction['description'] = Content::instance('FixInternalLink', $this->county->introduction)->activate();
		$introduction['image'] = $this->get_image_element($this->county->photo_category, $this->county->photo, $this->county->photo_description, 'medium');
		
		return $introduction;
	}

	protected function get_subsequent_introduction()
	{
		return array(
			'title' => sprintf(self::$DEFAULT_HEADER, $this->page, $this->county->name));
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
		return CountyCollector::getLogListForCounty($this->county->id, $total, $offset);
	}

	protected function get_item_count_result()
	{
		return CountyCollector::getLogCountForCounty($this->county->id);
	}

	protected function get_list_description_pattern()
	{
		return str_replace('%COUNTY%', $this->county->name, self::$NAVIGATION_DESCRIPTION);
	}

	protected function get_list_link_root()
	{
		return sprintf(self::$LINK_ROOT, $this->county->alias);
	}

}