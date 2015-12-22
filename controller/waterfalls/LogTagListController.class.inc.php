<?

Loader::load('collector', 'waterfall/LogTagCollector');
Loader::load('controller', 'waterfalls/DefaultLogListController');

final class LogTagListController extends DefaultLogListController
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

	private static $NAVIGATION_DESCRIPTION = 'displaying %d ~ %d of journal entries with %TAG%';
	private static $LINK_ROOT = '/journal/tag/%s/';

	private $tag;

	public function __construct()
	{
		$alias = URLDecode::getPiece(3);
		$this->tag = LogTagCollector::getTag($alias);
		
		if(!$this->tag)
			$this->eject();
		
		parent::__construct();
	}

	protected function get_initial_meta()
	{
		$meta_array = array();
		
		$meta_array['title'] = "{$this->tag->name} | " . self::$WEBSITE_TITLE;
		$meta_array['description'] = $this->tag->name;
		$meta_array['keywords'] = $this->get_keyword_array();
		
		return $meta_array;
	}

	protected function get_subsequent_meta()
	{
		$meta_array = array();
		
		$meta_array['title'] = sprintf(self::$DEFAULT_TITLE . ' | ' . self::$WEBSITE_TITLE, $this->companion->name, $this->page, $this->page_count);
		$meta_array['description'] = sprintf(self::$DEFAULT_DESCRIPTION, $this->page, $this->page_count, $this->tag->name);
		$meta_array['keywords'] = $this->get_keyword_array();
		
		return $meta_array;
	}

	private function get_keyword_array()
	{
		$keyword_array = self::$KEYWORD_ARRAY;
		array_unshift($keyword_array, strtolower($this->tag->name));
		return $keyword_array;
	}

	protected function get_initial_introduction()
	{
		return array(
			'title' => sprintf(self::$DEFAULT_HEADER, $this->page, $this->tag->name));
	}

	protected function get_subsequent_introduction()
	{
		return $this->get_initial_introduction();
	}

	protected function get_page_number_piece()
	{
		return URLDecode::getPiece(3);
	}

	protected function get_item_result($total, $offset)
	{
		return LogTagCollector::getLogListForTag($this->tag->id, $total, $offset);
	}

	protected function get_item_count_result()
	{
		return LogTagCollector::getLogCountForTag($this->tag->id);
	}

	protected function get_list_description_pattern()
	{
		return str_replace('%TAG%', $this->tag->name, self::$NAVIGATION_DESCRIPTION);
	}

	protected function get_list_link_root()
	{
		return sprintf(self::$LINK_ROOT, $this->tag->alias);
	}

}