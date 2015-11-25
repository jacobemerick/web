<?

Loader::load('collector', 'stream/ActivityCollector');
Loader::load('controller', '/SitemapController');

final class LifestreamSitemapController extends SitemapController
{

	private static $HOME_PAGE_RANK			= .9;
	private static $TAG_PAGE_RANK			= .3;
	private static $PAGINATED_PAGE_RANK		= .1;
	private static $POST_PAGE_RANK			= .5;
	private static $ABOUT_PAGE_RANK			= .7;

	private static $HOME_PAGE_CHANGEFREQ		= 'hourly';
	private static $TAG_PAGE_CHANGEFREQ			= 'daily';
	private static $PAGINATED_PAGE_CHANGEFREQ	= 'daily';
	private static $POST_PAGE_CHANGEFREQ		= 'weekly';
	private static $ABOUT_PAGE_CHANGEFREQ		= 'monthly';

	private static $POSTS_PER_PAGE = 15;

	protected function set_data()
	{
		$this->add_home_pages();
		$this->add_tag_pages();
		$this->add_post_pages();
		
		$this->addURL('about/', date('Y-m-01'), self::$ABOUT_PAGE_CHANGEFREQ, self::$ABOUT_PAGE_RANK);
	}

	private function add_home_pages()
	{
		$posts = ActivityCollector::getAll();
		
		$url = '';
		$this->add_paginated_pages($posts, $url, self::$HOME_PAGE_CHANGEFREQ, self::$HOME_PAGE_RANK);
	}

	private function add_tag_pages()
	{
		$posts = ActivityCollector::getAll();
		
		$tag_post_holder = array();
		foreach($posts as $post)
		{
			$tag_post_holder[$post->type][] = $post;
		}
		
		foreach($tag_post_holder as $tag => $posts)
		{
			$url = "{$tag}/";
			$this->add_paginated_pages($posts, $url, self::$TAG_PAGE_CHANGEFREQ, self::$TAG_PAGE_RANK);
		}
	}

	private function add_post_pages()
	{
		$posts = ActivityCollector::getAll();
		
		foreach($posts as $post)
		{
			$this->addURL("{$post->type}/{$post->id}/", date('Y-m-d', strtotime('last Monday')), self::$POST_PAGE_CHANGEFREQ, self::$POST_PAGE_RANK);
		}
	}

	private function add_paginated_pages($posts, $base_url, $changefreq, $rank)
	{
		switch($changefreq)
		{
			case 'hourly' :
				$lastmod = date('Y-m-d H:00:00');
			break;
			case 'daily' :
				$lastmod = date('Y-m-d');
			break;
			case 'weekly' :
				$lastmod = date('Y-m-d', strtotime('last Monday'));
			break;
			case 'monthly' :
				$lastmod = date('Y-m-01');
			break;
		}
		
		$this->addURL($base_url, $lastmod, $changefreq, $rank);
		for($i = 2; (($i - 1) * self::$POSTS_PER_PAGE) < count($posts); $i++)
		{
			$this->addURL("{$base_url}page/{$i}/", date('Y-m-01'), self::$PAGINATED_PAGE_CHANGEFREQ, self::$PAGINATED_PAGE_RANK);
		}
	}

}