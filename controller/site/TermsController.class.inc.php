<?

Loader::load('controller', 'site/DefaultPageController');

final class TermsController extends DefaultPageController
{

	protected function set_head_data()
	{
		$this->set_title("Terms of Use for Jacob Emerick's Sites");
		$this->set_description("Some basic (and boring) legal jargon and perferred usage of the content on Jacob Emerick's sites. Includes re-use terms and advice on retracing hikes.");
		$this->set_keywords(array('terms of use', 'legal', 'accountability', 'trespassing', 'Jacob Emerick'));
		
		parent::set_head_data();
	}

	protected function set_body_data()
	{
		$this->set_body('top_data', array('title' => 'Terms of Use'));
		
		$this->set_body('body_view', 'Terms');
		
		parent::set_body_data();
	}

}
