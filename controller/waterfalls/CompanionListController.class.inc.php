<?

Loader::load('collector', 'waterfall/CompanionCollector');
Loader::load('controller', 'waterfalls/DefaultLogListController');

final class CompanionListController extends DefaultLogListController
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

	private static $NAVIGATION_DESCRIPTION = 'displaying %d ~ %d of %d journal entries with %COMPANION%';
	private static $LINK_ROOT = '/companion/%s/';

	private $companion;

	public function __construct()
	{
		$alias = URLDecode::getPiece(2);
		$this->companion = CompanionCollector::getByAlias($alias);
		
		if(!$this->companion)
			$this->eject();
		
		parent::__construct();
	}

	protected function get_initial_meta()
	{
		$meta_array = array();
		
		$meta_array['title'] = "Hiking Stories with {$this->companion->name} | " . self::$WEBSITE_TITLE;
		$meta_array['description'] = $this->companion->description;
		$meta_array['keywords'] = $this->get_keyword_array();
		
		return $meta_array;
	}

	protected function get_subsequent_meta()
	{
		$meta_array = array();
		
		$meta_array['title'] = sprintf(self::$DEFAULT_TITLE . ' | ' . self::$WEBSITE_TITLE, $this->companion->name, $this->page, $this->page_count);
		$meta_array['description'] = sprintf(self::$DEFAULT_DESCRIPTION, $this->page, $this->page_count, $this->companion->name);
		$meta_array['keywords'] = $this->get_keyword_array();
		
		return $meta_array;
	}

	private function get_keyword_array()
	{
		$keyword_array = self::$KEYWORD_ARRAY;
		array_unshift($keyword_array, strtolower($this->companion->name));
		return $keyword_array;
	}

	protected function get_initial_introduction()
	{
		$introduction = array();
		
		$introduction['title'] = $this->companion->title;
		$introduction['description'] = Content::instance('FixInternalLink', $this->companion->introduction)->activate();
		$introduction['image'] = $this->get_image_element($this->companion->photo_category, $this->companion->photo, $this->companion->photo_description, 'medium');
		
		return $introduction;
	}

	protected function get_subsequent_introduction()
	{
		return array(
			'title' => sprintf(self::$DEFAULT_HEADER, $this->page, $this->companion->name));
	}

	protected function get_page_number_piece()
	{
		return URLDecode::getPiece(3);
	}

	protected function get_item_result($total, $offset)
	{
		return CompanionCollector::getLogListForCompanion($this->companion->id, $total, $offset);
	}

	protected function get_item_count_result()
	{
		return CompanionCollector::getLogCountForCompanion($this->companion->id);
	}

	protected function get_list_description_pattern()
	{
		return str_replace('%COMPANION%', $this->companion->name, self::$NAVIGATION_DESCRIPTION);
	}

	protected function get_list_link_root()
	{
		return sprintf(self::$LINK_ROOT, $this->companion->alias);
	}

}