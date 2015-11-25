<?

Loader::load('collector', array(
	'comment/CommentCollector',
	'waterfall/CountyCollector',
	'waterfall/WatercourseCollector',
	'waterfall/WaterfallCollector'));
Loader::load('controller', 'waterfalls/DefaultListController');

abstract class DefaultWaterfallListController extends DefaultListController
{

	protected static $ITEM_COUNT_PER_PAGE = 24;

	final protected function get_list_view()
	{
		return 'FallListing';
	}

	protected function get_item_count_per_page()
	{
		return self::$ITEM_COUNT_PER_PAGE;
	}

	final protected function format_item($item)
	{
		$item_array = array();
		
		$item_array['name'] = $item->name;
		$item_array['watercourse'] = $item->watercourse;
		$item_array['county'] = $item->county;
		$item_array['image'] = $this->get_image_element($item->photo_category, $item->photo, $item->photo_description, 'medium');
		$item_array['path'] = "/{$item->watercourse_alias}/{$item->waterfall_alias}/";
		$item_array['comment_count'] = CommentCollector::getCommentCountForURL(self::$WATERFALL_SITE_ID, "/{$item->watercourse_alias}/{$item->waterfall_alias}/");
		
		return $item_array;
	}

	final protected function get_sidebar()
	{
		$county_result = CountyCollector::getCountyList();
		$county_list = array();
		
		foreach($county_result as $county_row)
		{
			$county = new stdclass();
			$county->name = $county_row->name;
			$county->uri = "/{$county_row->alias}/";
			$county->count = $county_row->count;
			
			$county_list[] = $county;
		}
		
		$watercourse_result = WatercourseCollector::getWatercourseList();
		$watercourse_list = array();
		
		foreach($watercourse_result as $watercourse_row)
		{
			$watercourse = new stdclass();
			$watercourse->name = $watercourse_row->name;
			$watercourse->uri = "/{$watercourse_row->alias}/";
			$watercourse->count = $watercourse_row->count;
			
			$watercourse_list[] = $watercourse;
		}
		
		return array(
			'county_list' => $county_list,
			'watercourse_list' => $watercourse_list);
	}

}