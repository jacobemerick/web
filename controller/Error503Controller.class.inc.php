<?

Loader::load('controller', '/PageController');

class Error503Controller extends PageController
{

	protected function set_head_data()
	{
		$this->set_header_method('send503');
		$this->add_css('normalize');
		$this->add_css('503');
		
		$this->set_title("Jacob Emerick's 503 Page");
		$this->set_description('Global 503 page for sites under jacobemerick.com. Page not found!');
		$this->set_keywords(array());
	}

	protected function set_body_data()
	{
		$this->set_body_view('/503');
	}

}
