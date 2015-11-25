<?

Loader::load('controller', 'admin/DefaultPageController');

final class GeotagPhotoController extends DefaultPageController
{

	protected function set_data()
	{
		$this->set_title("Map - Admin Panel");
		
		$this->set_body('view', 'Map');
	}

}