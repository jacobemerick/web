<?

Loader::load('controller', '/PageController');

abstract class DefaultPageController extends PageController
{

	private static $MENU = array(
		array(
			'name' => 'About',
			'uri' => ''),
		array(
			'name' => 'Terms',
			'uri' => 'terms'),
		array(
			'name' => 'Change Log',
			'uri' => 'change-log'));

	protected function set_head_data()
	{
		$this->add_css('reset');
		$this->add_css('site');
	}

	protected function set_body_data()
	{
		$this->set_body('top_data', array());
		$this->set_body('body_data', array());
		
		$this->set_body('left_side_data', array('menu' => $this->get_menu()));
		
		$this->set_body('activity_array', $this->get_recent_activity());
		$this->set_body_view('Page');
	}

	private function get_menu()
	{
		$active_page = $this->get_active_page();
		
		$menu = array();
		foreach(self::$MENU as $item)
		{
			$menu[] = (object) array(
				'name' => $item['name'],
				'uri' => (strlen($item['uri']) > 0) ? "/{$item['uri']}/" : '/',
				'is_active' => ($item['name'] == $active_page));
		}
		
		return $menu;
	}

	private function get_active_page()
	{
		$current_uri = URLDecode::getPiece(1);
		
		if(!isset($current_uri))
			return 'About';
		
		$menu = self::$MENU;
		foreach($menu as $link)
		{
			if($link['uri'] == $current_uri)
				return $link['name'];
		}
		
		return 'About';
	}

}
