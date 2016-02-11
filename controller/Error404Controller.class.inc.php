<?

Loader::load('controller', '/PageController');

class Error404Controller extends PageController
{

	protected function set_head_data()
	{
		$this->set_header_method('send404');
		$this->add_css('normalize');
		$this->add_css('404');
		
		$this->set_title("Jacob Emerick's 404 Page");
		$this->set_head('description', 'Global 404 page for sites under jacobemerick.com. Page not found!');
		$this->set_head('keywords', '');
	}

	protected function set_body_data()
	{
		$this->set_body('site_list', $this->get_sites());
		
		$this->set_body_view('/404');
	}

	private function get_sites()
	{
    return [
      [
        'url' => 'https://home.jacobemerick.com/',
        'title' => "Jacob Emerick's Home",
        'name' => 'Home'
      ],
      [
        'url' => 'https://blog.jacobemerick.com/',
        'title' => "Jacob Emerick's Blog",
        'name' => 'Blog'
      ],
      [
        'url' => 'https://lifestream.jacobemerick.com/',
        'title' => "Jacob Emerick's Lifestream",
        'name' => 'Lifestream'
      ],
      [
        'url' => 'https://map.jacobemerick.com/',
        'title' => "Jacob Emerick's Hiking Map",
        'name' => 'Map'
      ],
      [
        'url' => 'https://portfolio.jacobemerick.com/',
        'title' => "Jacob Emerick's Portfolio",
        'name' => 'Portfolio',
      ],
      [
        'url' => 'https://www.waterfallsofthekeweenaw.com/',
        'title' => 'Waterfalls of the Keweenaw',
        'name' => 'Waterfalls'
      ]
  ];
	}

}
