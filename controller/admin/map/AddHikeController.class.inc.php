<?

Loader::load('controller', 'admin/DefaultPageController');

final class AddHikeController extends DefaultPageController
{

	protected function set_data()
	{
		$this->set_js('https://maps.googleapis.com/maps/api/js?sensor=false', 'admin/map');
		
		$this->set_title("Map - Add Hike - Admin Panel");
		
		$this->set_body('view', 'map/AddHike');
	}

}