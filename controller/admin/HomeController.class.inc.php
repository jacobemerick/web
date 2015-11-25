<?

Loader::load('controller', 'admin/DefaultPageController');

final class HomeController extends DefaultPageController
{

	protected function set_data()
	{
		$this->set_title("Home - Admin Panel");
		
		$this->set_body('view', 'Home');
	}

}