<?

Loader::load('router', 'Router');

class SiteRouter extends Router
{

	protected function get_redirect_array()
	{
		return array(
			(object) array(
				'pattern' => '@/index.(html|htm|php)$@',
				'replace' => '/'));
	}

	protected function get_direct_array()
	{
		return array(
			(object) array(
				'match' => '/',
				'controller' => 'HomeController'),
			(object) array(
				'match' => '/terms/',
				'controller' => 'TermsController'),
			(object) array(
				'match' => '/change-log/',
				'controller' => 'ChangelogController'),
			(object) array(
				'match' => '/contact/',
				'controller' => 'ContactController'));
	}

}