<?

Loader::load('controller', '/SitemapController');

final class HomeSitemapController extends SitemapController
{

	protected function set_data()
	{
		$this->addURL('', date('Y-m-d', strtotime('last Monday')), 'weekly', 1);
		$this->addURL('about/', date('Y-m-01'), 'monthly', .4);
		$this->addURL('contact/', date('Y-m-01'), 'monthly', .3);
	}

}