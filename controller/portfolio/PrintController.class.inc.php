<?

Loader::load('controller', 'portfolio/DefaultPageController');

final class PrintController extends DefaultPageController
{

	protected function set_data()
	{
		$this->set_title("Jacob Emerick's Portfolio");
		$this->set_head('description', "Jacob Emerick's Portfolio - examples of my work ranging from early print design to current web projects");
		$this->set_head('keywords', 'portfolio, Jacob Emerick, print design, examples, advertising, marketing campaigns, freelance, graphic design');
		
		$this->set_body('body_view', 'Listing');
		$this->set_body('left_side_data', array(
			'title' => "Print Gallery | Jacob Emerick's Portfolio",
			'menu' => $this->get_menu(),
			'home_link' => Loader::getRootURL()));
		$this->set_body('body_data', $this->get_listing_data(2));
		
		$this->set_body_view('Page');
	}

}