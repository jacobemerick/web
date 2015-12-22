<?

Loader::load('collector', 'waterfall/PeriodCollector');
Loader::load('controller', 'waterfalls/DefaultLogListController');

final class PeriodListController extends DefaultLogListController
{

	private static $DEFAULT_TITLE = '%s Hiking Stories, Page %d of %d';
	private static $DEFAULT_DESCRIPTION = 'Page %d of %d of epic %s hiking stories written by Jacob Emerick, all about his adventures hunting waterfalls in the Upper Peninsula of Michigan';
	private static $DEFAULT_HEADER = 'Page %d of Awesome %s Waterfall Hiking Stories';

	private static $KEYWORD_ARRAY = array(
		'journal',
		'stories',
		'blog',
		'waterfalls');

	private static $NAVIGATION_DESCRIPTION = 'displaying %d ~ %d of %d %PERIOD% journal entries';
	private static $LINK_ROOT = '/period/%s/';

	private $period;

	public function __construct()
	{
		$alias = URLDecode::getPiece(2);
		$this->period = PeriodCollector::getByAlias($alias);
		
		if(!$this->period)
			$this->eject();
		
		parent::__construct();
	}

	protected function get_initial_meta()
	{
		$meta_array = array();
		
		$meta_array['title'] = "Hiking Stories - {$this->period->name} | " . self::$WEBSITE_TITLE;
		$meta_array['description'] = $this->period->description;
		$meta_array['keywords'] = $this->get_keyword_array();
		
		return $meta_array;
	}

	protected function get_subsequent_meta()
	{
		$meta_array = array();
		
		$meta_array['title'] = sprintf(self::$DEFAULT_TITLE . ' | ' . self::$WEBSITE_TITLE, $this->period->name, $this->page, $this->page_count);
		$meta_array['description'] = sprintf(self::$DEFAULT_DESCRIPTION, $this->page, $this->page_count, $this->period->name);
		$meta_array['keywords'] = $this->get_keyword_array();
		
		return $meta_array;
	}

	private function get_keyword_array()
	{
		$keyword_array = self::$KEYWORD_ARRAY;
		array_unshift($keyword_array, strtolower($this->period->name));
		return $keyword_array;
	}

	protected function get_initial_introduction()
	{
		$introduction = array();
		
		$introduction['title'] = $this->period->title;
		$introduction['description'] = Content::instance('FixInternalLink', $this->period->introduction)->activate();
		$introduction['image'] = $this->get_image_element($this->period->photo_category, $this->period->photo, $this->period->photo_description, 'medium');
		
		return $introduction;
	}

	protected function get_subsequent_introduction()
	{
		return array(
			'title' => sprintf(self::$DEFAULT_HEADER, $this->page, $this->period->name));
	}

	protected function get_page_number_piece()
	{
		return URLDecode::getPiece(3);
	}

	protected function get_item_result($total, $offset)
	{
		return PeriodCollector::getLogListForPeriod($this->period->id, $total, $offset);
	}

	protected function get_item_count_result()
	{
		return PeriodCollector::getLogCountForPeriod($this->period->id);
	}

	protected function get_list_description_pattern()
	{
		$period = $this->period->name;
		$period = strtolower($period);
		$navigation_description = str_replace('%PERIOD%', $period, self::$NAVIGATION_DESCRIPTION);
		return $navigation_description;
	}

	protected function get_list_link_root()
	{
		return sprintf(self::$LINK_ROOT, $this->period->alias);
	}

}