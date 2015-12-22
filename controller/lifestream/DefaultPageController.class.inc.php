<?

Loader::load('collector', 'stream/ActivityCollector');
Loader::load('controller', '/PageController');
Loader::load('utility', 'Content');

abstract class DefaultPageController extends PageController
{

	protected function set_head_data()
	{
		$this->add_css('normalize');
		$this->add_css('lifestream');
	}

	protected function set_body_data()
	{
		$this->set_body_view('Page');
	}

}