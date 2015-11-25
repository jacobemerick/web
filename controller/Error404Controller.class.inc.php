<?

Loader::load('controller', '/PageController');

class Error404Controller extends PageController
{

	public function __construct()
	{
		parent::__construct();
		
		Visitor::update404Error();
	}

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
		Loader::load('collector', 'SiteCollector');
		$site_result = SiteCollector::getSitesForMenu();
		
		foreach($site_result as $site)
		{
			$site_array[] = array(
				'url' => $site->url,
				'title' => "Jacob Emerick's {$site->name}",
				'name' => $site->name,
				'description' => $site->description,
				'new' => $site->new);
		}
		
		return $site_array;
	}

}
