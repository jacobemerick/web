<?

Loader::load('controller', '/PageController');

abstract class DefaultPageController extends PageController
{

	protected $page = 1;
	private static $POSTS_PER_PAGE = 10;

	function __construct()
	{
		parent::__construct();
		
		$this->add_css('global');
		$this->add_css('portfolio');
		//$this->set_font_css('Molengo');
		$this->add_js('jquery-1.4.2');
		$this->add_js('portfolio');
		$this->add_js('imageloader');
	}

	protected function get_menu()
	{
		$menu = array(
			array(
				'name' => 'About',
				'link' => Loader::getRootURL()),
			array(
				'name' => 'Web',
				'link' => Loader::getRootURL() . 'web/'),
			array(
				'name' => 'Print',
				'link' => Loader::getRootURL() . 'print/'),
			array(
				'name' => 'Resume',
				'link' => Loader::getRootURL() . 'resume/'),
			array(
				'name' => 'Contact',
				'link' => Loader::getRootURL() . 'contact/'));
		
		if(!URLDecode::getPiece(1))
			$active_page = 'About';
		else
			$active_page = ucfirst(URLDecode::getPiece(1));
		
		foreach($menu as $menu_item)
		{
			$menu_item = (object) $menu_item;
			$menu_item->active = ($menu_item->name == $active_page);
			$final_menu[] = $menu_item;
		}
		
		return $final_menu;
	}

	protected function get_listing_data($category_id)
	{
		Loader::load('collector', 'portfolio/PortfolioCollector');
		$portfolio_result = PortfolioCollector::getPiecesForCategory($category_id);
		
		foreach($portfolio_result as $piece)
		{
			$piece_obj = new stdclass();
			$piece_obj->title = $piece->title;
			if("{$piece->category}" == 1)
				$piece_obj->url = Loader::getRootURL() . "web/{$piece->title_url}/";
			else
				$piece_obj->url = Loader::getRootURL() . "print/{$piece->title_url}/";
			$piece_obj->image = "/{$piece->image}";
			$piece_array[] = $piece_obj;
		}
		
		switch($category_id)
		{
			case 1 :
				$title = "Sites I've worked on";
			break;
			case 2 :
				$title = "Print pieces I've made";
			break;
		}
		
		return array(
			'title' => $title,
			'pieces' => $piece_array);
	}

}