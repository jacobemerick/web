<?

Loader::load('controller', '/PageController');

abstract class DefaultPageController extends PageController
{

	protected static $WEBSITE_TITLE = 'Waterfalls of the Keweenaw';
	protected static $PAGE_DESCRIPTION_LIMIT = 250;

	protected static $WATERFALL_SITE_ID = 5;

    protected $parent_navigation_item = '';

	protected function set_head_data()
	{
		$this->set_head('google_verification', 'm9ua4n8lp4FUYYa2UOh51UyZYfdivl-kRTtXKwaH0-s');
		$this->add_css('normalize');
		$this->add_css('waterfalls');
	}

    protected function add_waterfall_js()
    {
        $this->add_js('jquery');
        $this->add_js('imagelightbox');
        $this->add_js('waterfalls');
    }

	protected function set_body_data($page_type = 'normal')
	{
		$this->set_body('activity_array', $this->get_recent_activity());

        $this->set_body('main_navigation', array(
                (object) array(
                    'uri' => '/falls/',
                    'anchor' => 'Falls',
                    'is_active' => $this->parent_navigation_item === 'falls',
                ),
                (object) array(
                    'uri' => '/map/',
                    'anchor' => 'Map',
                    'is_active' => $this->parent_navigation_item === 'map',
                ),
                (object) array(
                    'uri' => '/journal/',
                    'anchor' => 'Journal',
                    'is_active' => $this->parent_navigation_item === 'journal',
                ),
                (object) array(
                    'uri' => '/about/',
                    'anchor' => 'About',
                    'is_active' => $this->parent_navigation_item === 'about',
                )
        ));

        if ($page_type == 'wide') {
            $this->set_body_view('WidePage');
        } else {
            $this->set_body_view('Page');
        }
    }

}
