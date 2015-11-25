<?

Loader::load('controller', 'portfolio/DefaultPageController');

final class ResumeController extends DefaultPageController
{

	protected function set_data()
	{
		$this->set_title("Jacob Emerick's Portfolio");
		$this->set_head('description', "Jacob Emerick's Portfolio - examples of my work ranging from early print design to current web projects");
		$this->set_head('keywords', 'portfolio, Jacob Emerick, resume, cv, qualifications, web development, web programming, print design, freelance');
		
		$this->set_body('body_view', 'Resume');
		$this->set_body('left_side_data', array(
			'title' => "Resume | Jacob Emerick's Portfolio",
			'menu' => $this->get_menu(),
			'home_link' => Loader::getRootURL()));
		$this->set_body('body_data', array());
		
		$this->set_body_view('Page');
	}

}