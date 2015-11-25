<?

Loader::load('utility', 'Header');

abstract class SitemapController
{

	private $xml;
	private $default_lastmod;

	abstract protected function set_data();

	function __construct()
	{
		$this->default_lastmod = date('Y-m-01');
		
		$dtd = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>';
		$this->xml = simplexml_load_string($dtd);
		
		Debugger::hide();
	}

	protected function addURL($loc, $lastmod = false, $changefreq = 'monthly', $priority = .5)
	{
		if(!$lastmod)
			$lastmod = $this->default_lastmod;
		
		$url = $this->xml->addChild('url');
		
		$loc = URLDecode::getBase() . $loc;
		$loc = htmlentities($loc);
		$url->addChild('loc', $loc);
		
		$lastmod = strtotime($lastmod);
		$lastmod = date('c', $lastmod);
		$url->addChild('lastmod', $lastmod);
		
		$url->addChild('changefreq', $changefreq);
		$url->addChild('priority', $priority);
	}

	public function activate()
	{
		$this->set_data();
		Header::sendSitemap();
		
		echo $this->xml->asXML();
	}

}