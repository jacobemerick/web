<?

Loader::load('controller', 'site/DefaultPageController');

final class HomeController extends DefaultPageController
{

	protected function set_head_data()
	{
		$this->set_title("Jacob Emerick's Site Information | General and Technical Information");
		$this->set_description("Meta information about Jacob Emerick's websites and content. Introduces the man behind the code, discusses the reasons behind the sites, and goes into some technical background of the custom framework.");
		$this->set_keywords(array('site', 'technical', 'support', 'help', 'information', 'Jacob Emerick'));
		
		parent::set_head_data();
	}

	protected function set_body_data()
	{
		$this->set_body('body_view', 'Home');
		
		parent::set_body_data();
	}

}