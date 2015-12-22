<?

Loader::load('collector', array(
	'blog/PostCollector',
	'blog/TagCollector'));
Loader::load('controller', '/SitemapController');
Loader::load('utility', 'Content');

final class BlogSitemapController extends SitemapController
{

	private static $HOME_PAGE_RANK			= .9;
	private static $CATEGORY_PAGE_RANK		= .3;
	private static $TAG_PAGE_RANK			= .2;
	private static $PAGINATED_PAGE_RANK		= .1;
	private static $POST_PAGE_RANK			= .8;

	private static $HOME_PAGE_CHANGEFREQ		= 'daily';
	private static $CATEGORY_PAGE_CHANGEFREQ	= 'weekly';
	private static $TAG_PAGE_CHANGEFREQ			= 'monthly';
	private static $PAGINATED_PAGE_CHANGEFREQ	= 'monthly';
	private static $POST_PAGE_CHANGEFREQ		= 'weekly';

	private static $POSTS_PER_PAGE		= 10;

	private static $CATEGORY_ARRAY = array(
		'hiking',
		'personal',
		'web-development');

	protected function set_data()
	{
		$this->add_home_pages();
		$this->add_category_pages();
		$this->add_tag_pages();
		$this->add_post_pages();
		
		$this->addURL('about/', date('Y-m-01'), 'monthly', .4);
	}

	private function add_home_pages()
	{
		$post_count = PostCollector::getMainPostCount();
		
		$url = '';
		$this->add_paginated_pages($post_count, $url, self::$HOME_PAGE_CHANGEFREQ, self::$HOME_PAGE_RANK);
	}

	private function add_category_pages()
	{
		$categories = self::$CATEGORY_ARRAY;
		
		foreach($categories as $category)
		{
			$post_count = PostCollector::getPostCountForCategory($category);
			
			$base_url = $category . '/';
			$this->add_paginated_pages($post_count, $base_url, self::$CATEGORY_PAGE_CHANGEFREQ, self::$CATEGORY_PAGE_RANK);
		}
	}

	private function add_tag_pages()
	{
		$tags = TagCollector::getAllTags();
		
		foreach($tags as $tag)
		{
			$post_count = PostCollector::getPostCountForTag($tag->id);
			
			$base_url = Content::instance('URLSafe', "tag/{$tag->tag}/")->activate();
			$this->add_paginated_pages($post_count, $base_url, self::$TAG_PAGE_CHANGEFREQ, self::$TAG_PAGE_RANK);
		}
	}

	private function add_post_pages()
	{
		$posts = PostCollector::getMainList(500);
		
		foreach($posts as $post)
		{
			$base_url = "{$post->category}/{$post->path}/";
			$this->addURL($base_url, date('Y-m-d', strtotime('last Monday')), self::$POST_PAGE_CHANGEFREQ, self::$POST_PAGE_RANK);
		}
	}

	private function add_paginated_pages($post_count, $base_url, $changefreq, $rank)
	{
		switch($changefreq)
		{
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
		for($i = 2; (($i - 1) * self::$POSTS_PER_PAGE) < $post_count; $i++)
		{
			$this->addURL("{$base_url}{$i}/", date('Y-m-01'), self::$PAGINATED_PAGE_CHANGEFREQ, self::$PAGINATED_PAGE_RANK);
		}
	}

}
