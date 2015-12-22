<?

Loader::load('collector', array(
	'image/PhotoCollector',
	'waterfall/WaterfallCollector'));
Loader::load('controller', 'waterfalls/DefaultWaterfallListController');

final class WaterfallListController extends DefaultWaterfallListController
{

	private static $PRIMARY_TITLE = 'Full Listing of Falls';
	private static $PRIMARY_DESCRIPTION = 'List of waterfalls found in the general Keweenaw Area, complete with photos, descriptions, directions, and maps.';
	private static $PRIMARY_INTRODUCTION_HEADER = 'A Giant List of Waterfalls';
	private static $PRIMARY_INTRODUCTION_IMAGE = 2212;
	private static $PRIMARY_INTRODUCTION_DESCRIPTION = "Jacob has been to a lot of waterfalls. From the sandstone drops of Ontonagon to the volcanic plunges of the Huron Mountains to Keweenaw Ridge's craggy slides, he's gotten around. Some of the falls end up being surprising finds, numerous drops that are not documented anywhere else, while others end up being huge disappointments that barely warrant the long searches and planning stages.";

	private static $SECONDARY_TITLE = 'Falls Listing, Page %d of %d';
	private static $SECONDARY_DESCRIPTION = 'Page %d of %d of waterfalls found in the general Keweenaw area.';
	private static $SECONDARY_INTRODUCTION_HEADER = 'Page %d of %d of the full waterfall listing';

	private static $KEYWORD_ARRAY = array(
		'journal',
		'stories',
		'blog',
		'waterfalls',
		'hiking companions');

	private static $NAVIGATION_DESCRIPTION = 'displaying %d ~ %d of %d total waterfalls';
	private static $LINK_ROOT = '/falls/';

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
		
		$meta_array['title'] = sprintf(self::$SECONDARY_TITLE . ' | ' . self::$WEBSITE_TITLE, $this->page, $this->page_count);
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
		return WaterfallCollector::getList($total, $offset);
	}

	protected function get_item_count_result()
	{
		return WaterfallCollector::getListCount();
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
