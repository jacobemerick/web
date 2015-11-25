<?

Loader::load('router', 'Router');

final class AboutRouter extends Router
{

	protected function get_redirect_array()
	{
		return array(
			(object) array(
				'pattern' => '@/index.(html|htm|php)$@',
				'replace' => '/'),
			(object) array(
				'pattern' => '@/.*@',
				'replace' => 'http://home.jacobemerick.com/'),
			(object) array(
				'pattern' => '@^/page/([0-9]+)(/?)$@',
				'replace' => 'http://lifestream.jacobemerick.com/page/$1/'));
	}

	protected function get_direct_array()
	{
		return array(
			(object) array(
				'match' => '/',
				'controller' => 'HomeController'));
	}

}