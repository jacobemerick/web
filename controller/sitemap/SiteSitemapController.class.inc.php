<?

Loader::load('controller', '/SitemapController');

final class SiteSitemapController extends SitemapController
{

	protected function set_data()
	{
		$this->addURL('', date('Y-m-01'), 'monthly', 1);
		$this->addURL('terms/', date('Y-m-01'), 'monthly', .3);
		$this->addURL('change-log/', date('Y-m-d', strtotime('last Monday')), 'weekly', .1);
		$this->addURL('contact/', date('Y-01-01'), 'yearly', .6);
	}

}