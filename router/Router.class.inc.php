<?

Loader::load('utility', array(
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
		
		switch(URLDecode::getSite())
		{
			case 'ajax' :
				return 'AjaxRouter';
			break;
			case 'blog' :
				return 'BlogRouter';
			break;
			case 'home' :
				return 'HomeRouter';
			break;
			case 'lifestream' :
				return 'LifestreamRouter';
			break;
			case 'portfolio' :
				return 'PortfolioRouter';
			break;
			case 'waterfalls' :
				return 'WaterfallRouter';
			break;
		}
		
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
		
		return URLDecode::getSite();
	}

	private function requires_trailing_slash()
	{
		return (
			URLDecode::getExtension() != 'json' &&
            strstr(URLDecode::getURI(), '#') === false);
	}

}
