<?

Loader::load('controller', '/PageController');

abstract class DefaultPageController extends PageController
{

	protected function set_head_data()
	{
		$this->add_css('normalize');
		$this->add_css('home');
	}

	protected function set_body_data()
	{
		$this->set_body('activity_array', $this->get_recent_activity());
	}

}