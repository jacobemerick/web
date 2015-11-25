<?

Loader::load('controller', '/PageController');
Loader::load('utility', 'Cookie');

abstract class DefaultPageController extends PageController
{

	private static $USERNAME = 'secret';
	private static $PASSWORD = 'secreter';
	private static $SALT = 'eh';

	private static $MENU_ARRAY = array(
		array(
			'link' => '/',
			'label' => 'Home'),
		array(
			'link' => '/blog/',
			'label' => 'Blog',
			'submenu' => array(
				array(
					'link' => '/blog/add-post/',
					'label' => 'Add Post'),
				array(
					'link' => '/blog/manage-post/',
					'label' => 'Manage Posts'))),
		array(
			'link' => '/map/',
			'label' => 'Map',
			'submenu' => array(
				array(
					'link' => '/map/add-hike/',
					'label' => 'Add Hike'),
				array(
					'link' => '/map/manage-hike/',
					'label' => 'Manage Hike'),
				array(
					'link' => '/map/geotag-photo/',
					'label' => 'Geotag Photos'))));

	function __construct()
	{
		parent::__construct();
		
		$this->set_head('description', '');
		$this->set_head('keywords', '');
		$this->set_css('admin');
		
		if($this->check_authorization() == true)
		{
			$this->set_body('menu_array', $this->get_menu_array());
			$this->set_body_view('Page');
		}
		else
			$this->set_body_view('Login');
	}

	final private function check_authorization()
	{
		if(isset($_POST))
		{
			if(
				isset($_POST['username']) == self::$USERNAME &&
				$_POST['username'] == 'jpemeric' &&
				isset($_POST['password']) &&
				$_POST['password'] == self::$PASSWORD &&
                false
            ) {
				$value = md5(sprintf(self::$SALT, self::$USERNAME, self::$PASSWORD));
				Cookie::instance('AdminUser')->setValue($value)->save();
				return true;
			}
		}
		$cookie = Cookie::instance('AdminUser');
		return ($cookie->exists() && $cookie->getValue() == md5(sprintf(self::$SALT, self::$USERNAME, self::$PASSWORD)));
	}

	final private function get_menu_array()
	{
		$menu_array = array();
		foreach(self::$MENU_ARRAY as $menu_item)
		{
			$menu_item_object = new stdclass();
			$menu_item_object->link = $menu_item['link'];
			$menu_item_object->label = $menu_item['label'];
			$menu_item_object->is_active = URLDecode::getPiece(1) == trim($menu_item['link'], '/');
			
			if(isset($menu_item['submenu']))
			{
				$submenu_array = array();
				foreach($menu_item['submenu'] as $submenu_item)
				{
					$submenu_item_object = new stdclass();
					$submenu_item_object->link = $submenu_item['link'];
					$submenu_item_object->label = $submenu_item['label'];
					$submenu_array[] = $submenu_item_object;
				}
				$menu_item_object->submenu = $submenu_array;
			}
			
			$menu_array[] = $menu_item_object;
		}
		
		return array('menu_array' => $menu_array);
	}

}
