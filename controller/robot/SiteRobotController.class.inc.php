<?

Loader::load('controller', '/RobotController');

final class SiteRobotController extends RobotController
{

	protected function set_data()
	{
		$this->allow_for_all_robots();
	}

}