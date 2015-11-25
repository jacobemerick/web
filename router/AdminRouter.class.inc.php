<?

Loader::load('router', 'Router');

class AdminRouter extends Router
{

	protected function get_redirect_array()
	{
		return array();
	}

	protected function get_direct_array()
	{
		return array(
			(object) array(
				'match' => '/',
				'controller' => 'HomeController'),
			(object) array(
				'match' => '/map/',
				'controller' => 'map/MainController'),
			(object) array(
				'match' => '/map/add-hike/',
				'controller' => 'map/AddHikeController'),
			(object) array(
				'match' => '/map/manage-hike/',
				'controller' => 'map/ManageHikeController'),
			(object) array(
				'match' => '/map/geotag-photo/',
				'controller' => 'map/GeotagPhotoController'));
	}

}