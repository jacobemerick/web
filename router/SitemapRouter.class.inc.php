<?

Loader::load('router', 'Router');

final class SitemapRouter extends Router
{

	protected function get_redirect_array()
	{
		return array(
			(object) array(
				'pattern' => '@^/$@',
				'replace' => 'http://home.jacobemerick.com/'));
	}

	protected function get_direct_array()
	{
		$site = URLDecode::getSite();
        if ($site == 'waterfalls') {
            $site = 'waterfall';
        }
		$site = ucwords($site);
		
		return array(
			(object) array(
				'match' => '/sitemap.xml',
				'controller' => "{$site}SitemapController"));
	}

}