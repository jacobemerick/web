<?

Loader::load('utility', 'Header');

abstract class RSSController
{

	private $xml;

	abstract protected function set_header_data();
	abstract protected function set_body_data();

	final public function __construct()
	{
		$dtd = '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom"></rss>';
		$this->xml = simplexml_load_string($dtd);
		
		Debugger::hide();
	}

	final protected function setTitle($title)
	{
		$this->xml->channel->addChild('title', $title);
	}

	final protected function setLink($url = null)
	{
		if(!isset($url))
			$url = URLDecode::getBase();
		$this->xml->channel->addChild('link', $url);
	}

	final protected function setDescription($description)
	{
		$this->xml->channel->addChild('description', $description);
	}

	final protected function setAtom($url)
	{
		$atom = $this->xml->channel->addChild('link', '', 'http://www.w3.org/2005/Atom');
		$atom->addAttribute('href', URLDecode::getBase() . $url);
		$atom->addAttribute('rel', 'self');
		$atom->addAttribute('type', 'application/rss+xml');
	}

	final protected function setLanguage($language = 'en-us')
	{
		$this->xml->channel->addChild('language', $language);
	}

	final protected function setCopyright($copyright = null)
	{
		if(!isset($copyright))
			$copyright = 'Copyright ' . date('Y') . ' Jacob Emerick';
		$this->xml->channel->addChild('copyright', $copyright);
	}

	final protected function setWebMaster($webmaster = '')
	{
        if ($webmaster == '') {
            global $config;
            $webmaster = "{$config->admin_email} (Jacob Emerick)";
        }
		$this->xml->channel->addChild('webMaster', $webmaster);
	}

	final protected function setPubDate($date = null)
	{
		if(!isset($date))
			$date = date('r');
		$this->xml->channel->addChild('pubDate', $date);
	}

	final protected function setTTL($ttl = 60)
	{
		$this->xml->channel->addChild('ttl', $ttl);
	}

	final protected function addItem($title, $link, $description, $category, $pubDate)
	{
		$item = $this->xml->channel->addChild('item');
		$item->addChild('title', $title);
		$item->addChild('link', URLDecode::getBase() . $link);
		$item->addChild('description', htmlentities($description));
		$item->addChild('category', $category);
		$item->addChild('pubDate', $pubDate);
		$item->addChild('guid', URLDecode::getBase() . $link);
	}

	final public function activate()
	{
		$this->xml->addChild('channel');
		$this->set_header_data();
		$this->set_body_data();
		Header::sendRSS();
		
		echo $this->xml->asXML();
	}

}
