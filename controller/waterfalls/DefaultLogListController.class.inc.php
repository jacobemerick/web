<?

Loader::load('collector', array(
	'waterfall/CompanionCollector',
	'waterfall/LogCollector',
	'waterfall/PeriodCollector'));
Loader::load('controller', 'waterfalls/DefaultListController');

abstract class DefaultLogListController extends DefaultListController
{

	private static $ITEM_COUNT_PER_PAGE = 10;

	final protected function get_list_view()
	{
		return 'LogListing';
	}

	final protected function get_item_count_per_page()
	{
		return self::$ITEM_COUNT_PER_PAGE;
	}

	final protected function format_item($item)
	{
		$item_array = array();
		
		$item_array['title'] = $item->title;
		$item_array['image'] = $this->get_image_element($item->photo_category, $item->photo, $item->photo_description);
		$item_array['waterfall_list'] = LogCollector::getWaterfallListForLog($item->id);
		$item_array['introduction'] = $item->introduction;
		$item_array['path'] = "/journal/{$item->alias}/";
		$item_array['comment_count'] = 0; // todo - this
		$item_array['date'] = $this->get_parsed_date($item->date);
		
		return $item_array;
	}

	final protected function get_sidebar()
	{
		$companion_result = CompanionCollector::getCompanionList();
		$companion_list = array();
		
		foreach($companion_result as $companion_row)
		{
			$companion = new stdclass();
			$companion->name = $companion_row->name;
			$companion->uri = "/companion/{$companion_row->alias}/";
			$companion->count = $companion_row->count;
			
			$companion_list[] = $companion;
		}
		
		$period_result = PeriodCollector::getPeriodList();
		$period_list = array();
		
		foreach($period_result as $period_row)
		{
			$period = new stdclass();
			$period->name = $period_row->name;
			$period->uri = "/period/{$period_row->alias}/";
			$period->count = $period_row->count;
			
			$period_list[] = $period;
		}
		
		return array(
			'companion_list' => $companion_list,
			'period_list' => $period_list);
	}

}
