<?

Loader::load('router', 'Router');

final class HomeRouter extends Router
{

	protected function get_redirect_array()
	{
		return array(
			(object) array(
				'pattern' => '@/index.(html|htm|php)$@',
				'replace' => ''));
	}

	protected function get_direct_array()
	{
		return array(
			(object) array(
				'match' => '/',
				'controller' => 'HomeController'),
			(object) array(
				'match' => '/about/',
				'controller' => 'AboutController'),
			(object) array(
				'match' => '/contact/',
				'controller' => 'ContactController'));
	}

}