<?

Loader::load('utility', array(
	'ImageOld',
	'Request',
	'URLDecode'));

abstract class Router
{

	public function __construct() {}

	public static function instance()
	{
		$router_name = self::get_router_name();
		$router = Loader::loadNew('router', $router_name);
		$router->route();
	}

	private static function get_router_name()
	{
		if(Request::isAJAX())
			return 'AJAXRouter';
		if(URLDecode::getURI() == '/robots.txt')
			return 'RobotRouter';
		if(URLDecode::getURI() == '/sitemap.xml' && URLDecode::getSite() != 'about')
			return 'SitemapRouter';
		if(URLDecode::getURI() == '/rss/')
			return 'RSSRouter';
		if(URLDecode::getExtension() == 'css')
			return 'StyleRouter';
		if(URLDecode::getExtension() == 'js')
			return 'ScriptRouter';
		if(URLDecode::getExtension() == 'ico')
			return 'ImageRouter';
		if(URLDecode::getExtension() == 'jpg')
			return 'ImageRouter';
		if(URLDecode::getExtension() == 'png')
			return 'ImageRouter';
		
		switch(URLDecode::getSite())
		{
			case 'about' :
				return 'AboutRouter';
			break;
			case 'admin' :
				return 'AdminRouter';
			break;
			case 'ajax' :
				return 'AjaxRouter';
			break;
			case 'blog' :
				return 'BlogRouter';
			break;
			case 'home' :
				return 'HomeRouter';
			break;
			case 'images' :
				return 'ImageRouter';
			break;
			case 'lifestream' :
				return 'LifestreamRouter';
			break;
			case 'music' :
				return 'MusicRouter';
			break;
			case 'portfolio' :
				return 'PortfolioRouter';
			break;
			case 'site' :
				return 'SiteRouter';
			break;
			case 'waterfalls' :
				return 'WaterfallRouter';
			break;
		}
		
		Debugger::logMessage("The router for " . URLDecode::getSite() . " was not loaded.");
		Loader::loadNew('controller', '/Error404Controller')->activate();
	}

	protected function route()
	{
		$uri = URLDecode::getURI();
		
		$this->check_for_redirect($uri);
		
		$controller = $this->get_controller($uri);
		Loader::loadNew('controller', $controller)
			->activate();
	}

	abstract protected function get_redirect_array();
	abstract protected function get_direct_array();

	final protected function check_for_redirect($redirect_uri)
	{
		foreach($this->get_redirect_array() as $check)
		{
			$redirect_uri = preg_replace($check->pattern, $check->replace, $redirect_uri);
		}
		
		$redirect_uri = $this->check_for_special_redirect($redirect_uri);
		
		if($this->requires_trailing_slash() && substr($redirect_uri, -1) != '/')
			$redirect_uri .= '/';
		
        if (URLDecode::getHost() == 'waterfalls.jacobemerick.com') {
            $redirect_uri = 'http://' . (!Loader::isLive() ? 'dev' : 'www') . '.waterfallsofthekeweenaw.com' . $redirect_uri;
        }
        
		if($redirect_uri == URLDecode::getURI())
			return;
		
		$controller_check = $redirect_uri;
		if(substr($redirect_uri, 0, 4) == 'http')
			$controller_check = preg_replace('@^http://([a-z\.]+)@', '', $redirect_uri);
		
		$controller = $this->get_controller($controller_check);
		if($controller == '/Error404Controller')
		{
			Loader::loadNew('controller', '/Error404Controller')
				->activate();
			exit;
		}

		if($this->get_primary_folder() == 'images') {
			$file = $controller_check;//URLDecode::getURI();

			if (
				URLDecode::getSite() == 'images' ||
				URLDecode::getExtension() == 'ico') {
				$file = "/css/{$file}";
			} else if (URLDecode::getSite() == 'music') {
				$file = "/music/{$file}";
			} else if (URLDecode::getSite() == 'portfolio') {
				$file = "/portfolio/{$file}";
			} else if (substr($file, 0, 7) == '/photo/') {
				$file = '/photo/processed/' . substr($file, 7);
			}

			$image = new ImageOld($file);
        	        if(!$image->isValid()) {
                	        Loader::loadNew('controller', '/Error404Controller')->activate();
				exit();
			}
		}
		
		if(substr($redirect_uri, 0, 4) != 'http')
		{
			$redirect_uri = substr($redirect_uri, 1);
			$redirect_uri = URLDecode::getBase() . $redirect_uri;
		}
		
		Loader::loadNew('controller', '/Error301Controller', (array) $redirect_uri)
			->activate();
	}

	protected function check_for_special_redirect($uri)
	{
		return $uri;
	}

	final private function get_controller($uri)
	{
		foreach($this->get_direct_array() as $check)
		{
			if($uri == $check->match)
				return "{$this->get_primary_folder()}/{$check->controller}";
			
			if(preg_match("@^{$check->match}$@", $uri))
				return "{$this->get_primary_folder()}/{$check->controller}";
		}
		
		return '/Error404Controller';
	}

	final private function get_primary_folder()
	{
		if(Request::isAjax())
			return 'ajax';
		if(URLDecode::getURI() == '/robots.txt')
			return 'robot';
		if(URLDecode::getURI() == '/sitemap.xml')
			return 'sitemap';
		if(URLDecode::getURI() == '/rss/')
			return 'rss';
		if(URLDecode::getExtension() == 'css')
			return 'styles';
		if(URLDecode::getExtension() == 'js')
			return 'scripts';
		if(
			URLDecode::getExtension() == 'jpg' ||
			URLDecode::getExtension() == 'ico' ||
			URLDecode::getExtension() == 'png')
			return 'images';
		
		return URLDecode::getSite();
	}

	private function requires_trailing_slash()
	{
		return (
			URLDecode::getURI() != '/robots.txt' &&
			URLDecode::getURI() != '/sitemap.xml' &&
			URLDecode::getExtension() != 'json' &&
			URLDecode::getSite() != 'images' &&
			URLDecode::getSite() != 'scripts' &&
			URLDecode::getSite() != 'styles' &&
			URLDecode::getExtension() != 'css' &&
			URLDecode::getExtension() != 'js' &&
			URLDecode::getExtension() != 'jpg' &&
			URLDecode::getExtension() != 'png' &&
			URLDecode::getExtension() != 'ico' &&
            strstr(URLDecode::getURI(), '#') === false);
	}

}
