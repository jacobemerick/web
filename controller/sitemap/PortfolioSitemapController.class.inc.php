<?

Loader::load('collector', 'portfolio/PortfolioCollector');
Loader::load('controller', '/SitemapController');

final class PortfolioSitemapController extends SitemapController
{

	protected function set_data()
	{
		$this->addURL('');
		$this->addURL('print/', date('Y-m-01'), 'monthly', .1);
		$this->addURL('web/', date('Y-m-01'), 'monthly', .1);
		$this->addURL('contact/', date('Y-01-01'), 'yearly', .4);
		$this->addURL('resume/', date('Y-m-01'), 'monthly', .9);
		
		$pieces = PortfolioCollector::getAllPieces();
		
		foreach($pieces as $piece)
		{
			if($piece->category == 1)
				$this->addURL("web/{$piece->title_url}/", date('Y-01-01'), 'yearly', .7);
			else
				$this->addURL("print/{$piece->title_url}/", date('Y-01-01'), 'yearly', .7);
		}
	}

}