<?

Loader::load('controller', 'waterfalls/DefaultListController');

final class SearchListController extends DefaultListController
{

	private static $TITLE = 'Search Listing';
	private static $DESCRIPTION = '';

	private static $KEYWORD_ARRAY = array();

	protected function set_head_data()
	{
		parent::set_head_data();
		
		$this->set_title(self::$TITLE);
		$this->set_description(self::$DESCRIPTION);
		$this->set_keywords(self::$KEYWORD_ARRAY);
	}

	protected function get_introduction()
	{
		return;
	}

	protected function get_page_number()
	{
		$page = URLDecode::getPiece(2);
		if(isset($page) && is_numeric($page))
			return $page;
		return 1;
	}

	protected function get_items()
	{
		return array();
	}

	protected function get_list_description()
	{
		return 'yay cloud';
	}

	protected function get_list_next_link()
	{
		return '/';
	}

	protected function get_list_prev_link()
	{
		return '/';
	}

	private $total_post_count;
	protected function get_item_count()
	{
		return 20;
	}

	protected function get_item_count_per_page()
	{
		return 20;
	}

}