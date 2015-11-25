<?

Loader::load('controller', 'PageController');
Loader::load('utility', 'Cookie');

class HomeController extends PageController
{

	function __construct()
	{
		parent::__construct();
		
		$this->add_css('global');
		$this->add_css('music');
		//$this->set_font_css('Molengo');
		$this->add_js('jquery-1.4.2');
		$this->add_js('music');
		$this->add_js('jquery-ui-1.8.2');
	}

	protected function set_data()
	{
		$this->set_title("Jacob Emerick's Popular Music Page");
		$this->set_head('description', 'Popular music page for Jacob Emerick - a graphical representation of his most played albums over time.');
		$this->set_head('keywords', 'popular music, music, albums, lastfm, Jacob Emerick, Jacob, Emerick, jacobemerick');
		
		$popupCookie = Cookie::instance('MusicHidePopup');
		
		if($popupCookie->exists() && $popupCookie->getValue() == true)
			$this->set_body('hide_popup', true);
		else
		{
			$popupCookie->setValue(true)
				->save();
			$this->set_body('hide_popup', false);
		}
		
		$this->set_body('supported_browser', $this->is_supported_browser());
		
		$this->set_body_view('Home');
	}

	private function is_supported_browser()
	{
		return true; // me thinks this should be good
		if(Visitor::getBrowser()->getName() == 'firefox')
			return true;
		if(Visitor::getBrowser()->getName() == 'chrome')
			return true;
		if(Visitor::getBrowser()->getName() == 'safari')
			return true;
		if(Visitor::getBrowser()->getName() == 'opera')
			return true;
		return false;
	}

}