<?

Loader::load('collector', array(
	'image/PhotoCollector',
	'waterfall/LogCollector'));
Loader::load('controller', 'waterfalls/DefaultLogListController');

final class LogListController extends DefaultLogListController
{

	private static $PRIMARY_TITLE = 'Journal from Waterfall Hikes';
	private static $PRIMARY_DESCRIPTION = 'Stories written by Jacob Emerick about his epic waterfall adventures in the general Keweenaw, Ontonagon, and Marquette areas.';
	private static $PRIMARY_INTRODUCTION_HEADER = 'Journal of Waterfall Adventuring';
	private static $PRIMARY_INTRODUCTION_IMAGE = 707;
	private static $PRIMARY_INTRODUCTION_DESCRIPTION = 'Whether he is hiking alone through the woods, with Logan running ahead to chase down deer, or with a group of friends, every hike that Jacob sets out turns into an adventure. Hopping from slick rock to rock along a small creek in the city, splashing through deep water over an uncertain riverbed, or pushing thick branches out of the way in thick brush, every journey turns into a little story of discovery.';

	private static $SECONDARY_TITLE = 'Journal Entries - Page %d';
	private static $SECONDARY_DESCRIPTION = 'Page %d of %d of epic hiking stories written by Jacob Emerick, all about his adventures hunting waterfalls in the Upper Peninsula of Michigan';
	private static $SECONDARY_INTRODUCTION_HEADER = 'Waterfall Adventure Journal, Page %d of %d';

	private static $KEYWORD_ARRAY = array(
		'journal',
		'travel log',
		'blog',
		'waterfalls',
		'hiking companions');

	private static $NAVIGATION_DESCRIPTION = 'displaying %d ~ %d of %d total journal entries';
	private static $LINK_ROOT = '/journal/';

	protected function get_initial_meta()
	{
		$meta_array = array();
		
		$meta_array['title'] = self::$PRIMARY_TITLE . ' | ' . self::$WEBSITE_TITLE;
		$meta_array['description'] = self::$PRIMARY_DESCRIPTION;
		$meta_array['keywords'] = self::$KEYWORD_ARRAY;
		
		return $meta_array;
	}

	protected function get_subsequent_meta()
	{
		$meta_array = array();
		
		$meta_array['title'] = sprintf(self::$SECONDARY_TITLE . ' | ' . self::$WEBSITE_TITLE, $this->page);
		$meta_array['description'] = sprintf(self::$SECONDARY_DESCRIPTION, $this->page, $this->page_count);
		$meta_array['keywords'] = self::$KEYWORD_ARRAY;
		
		return $meta_array;
	}

	protected function get_initial_introduction()
	{
		$introduction = array();
		
		$introduction['title'] = self::$PRIMARY_INTRODUCTION_HEADER;
		$introduction['description'] = self::$PRIMARY_INTRODUCTION_DESCRIPTION;
		
		$image = PhotoCollector::getRow(self::$PRIMARY_INTRODUCTION_IMAGE);
		$introduction['image'] = $this->get_image_element($image->category, $image->name, $image->description, 'medium');
		
		return $introduction;
	}

	protected function get_subsequent_introduction()
	{
		return array(
			'title' => sprintf(self::$SECONDARY_INTRODUCTION_HEADER, $this->page, $this->page_count));
	}

	protected function get_page_number_piece()
	{
		return URLDecode::getPiece(2);
	}

	protected function get_item_result($total, $offset)
	{
		return LogCollector::getList($total, $offset);
	}

	protected function get_item_count_result()
	{
		return LogCollector::getListCount();
	}

	protected function get_list_description_pattern()
	{
		return self::$NAVIGATION_DESCRIPTION;
	}

	protected function get_list_link_root()
	{
		return self::$LINK_ROOT;
	}

}