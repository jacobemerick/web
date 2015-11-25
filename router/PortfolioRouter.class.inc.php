<?

Loader::load('router', 'Router');

class PortfolioRouter extends Router
{

	protected function get_redirect_array()
	{
		return array(
			(object) array(
				'pattern' => '@/index.(html|htm|php)$@',
				'replace' => '/'),
			(object) array(
				'pattern' => '@^/page_([0-9]+)(/?)$@',
				'replace' => '/'),
			(object) array(
				'pattern' => '@^/client_morha(/?)$@',
				'replace' => '/web/morha-site/'),
			(object) array(
				'pattern' => '@^/image/portfolio/morha_2008-03-17.jpg$@',
				'replace' => '/web/morha-site/'),
			(object) array(
				'pattern' => '@^/image/portfolio/penny-wars_2007-12-12_one.jpg$@',
				'replace' => '/web/penny-wars-flash-site/'));
	}

	protected function check_for_special_redirect($uri)
	{
		if(preg_match('@^/piece/([a-z0-9-]+)(/?)$@', $uri, $matches))
		{
			Loader::load('collector', 'portfolio/PortfolioCollector');
			$piece = PortfolioCollector::getPieceByURI($matches[1]);
			
			if($piece === null)
			{
				Loader::loadNew('controller', '/Error404Controller')
					->activate();
			}
			
			$category = ($piece->category == 1) ? 'web' : 'print';
			
			$title = $piece->title_url;
			
			$uri = "/{$category}/{$title}/";
			return $uri;
		}
		return $uri;
	}

	protected function get_direct_array()
	{
		return array(
			(object) array(
				'match' => '/',
				'controller' => 'HomeController'),
			(object) array(
				'match' => '/print/',
				'controller' => 'PrintController'),
			(object) array(
				'match' => '/web/',
				'controller' => 'SiteController'),
			(object) array(
				'match' => '/contact/',
				'controller' => 'ContactController'),
			(object) array(
				'match' => '/resume/',
				'controller' => 'ResumeController'),
			(object) array(
				'match' => '/(web|print)/([a-z0-9-]+)/',
				'controller' => 'PieceController'));
	}

}