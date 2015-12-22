<?

Loader::load('router', 'Router');

class BlogRouter extends Router
{

	protected function get_redirect_array()
	{
		return array(
			(object) array(
				'pattern' => '@^/page_([0-9]+)/$@',
				'replace' => '/$1/'),
			(object) array(
				'pattern' => '@/index.(html|htm|php)$@',
				'replace' => '/'),
			(object) array(
				'pattern' => '@^/([0-9]{4})-([a-z]+)/$@',
				'replace' => '/'),
			(object) array(
				'pattern' => '@^/([0-9]{4})-([a-z]+)/([0-9]+)/$@',
				'replace' => '/'),
			(object) array(
				'pattern' => '@^/month_([a-z]{3,})_([0-9]{4})(/?)$@',
				'replace' => '/'),
			(object) array(
				'pattern' => '@^/month_([a-z]{3,})_([0-9]{4})/page_([0-9]+)(/?)$@',
				'replace' => '/'),
			(object) array(
				'pattern' => '@^/category_([a-z-]+)(/?)$@',
				'replace' => '/$1/'),
			(object) array(
				'pattern' => '@^/category_([a-z-]+)/page_([0-9]+)(/?)$@',
				'replace' => '/$1/$2/'),
			(object) array(
				'pattern' => '@^/tag_([a-z-]+)(/?)$@',
				'replace' => '/tag/$1/'),
			(object) array(
				'pattern' => '@^/tag_([a-z-]+)/page_([0-9]+)(/?)$@',
				'replace' => '/tag/$1/$2/'),
			(object) array(
				'pattern' => '@^/blog/(.*)$@',
				'replace' => '/$1'));
	}

	protected function check_for_special_redirect($uri)
	{
		if(preg_match('@^/post_([0-9]{4}-[0-9]{2}-[0-9]{2})_([a-z0-9-]+)(/?)$@', $uri, $matches))
		{
			Loader::load('collector', 'blog/PostCollector');
			$post = PostCollector::getPostByURI($matches[2]);
			if(!$post)
			{
				Loader::loadNew('controller', '/Error404Controller')
					->activate();
			}
			
			Loader::load('utility', 'Content');
			$uri = Content::instance('URLSafe', "/{$post->category}/{$post->title_url}/")->activate();
		}
		else
		{
			$post_uri = URLDecode::getPiece(1);
			if($post_uri !== null)
			{
				Loader::load('collector', 'blog/PostCollector');
				$post = PostCollector::getPostByURI($post_uri);
				
				if($post != false)
				{
					Loader::load('utility', 'Content');
					$uri = Content::instance('URLSafe', "/{$post->category}/{$post->title_url}/")->activate();
				}
			}
		}
		if($uri == '/search/')
		{
			if(Request::getGet('submit') == 'Submit Search' && Request::getGet('search'))
			{
				$uri .= Request::getGet('search');
				$uri .= '/';
			}
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
				'match' => '/([0-9]+)/',
				'controller' => 'HomeController'),
			(object) array(
				'match' => '/about/',
				'controller' => 'AboutController'),
			(object) array(
				'match' => '/(hiking|personal|web-development)/',
				'controller' => 'CategoryController'),
			(object) array(
				'match' => '/(hiking|personal|web-development)/([0-9]+)/',
				'controller' => 'CategoryController'),
			(object) array(
				'match' => '/tag/([a-z0-9-]+)/',
				'controller' => 'TagController'),
			(object) array(
				'match' => '/tag/([a-z-]+)/([0-9]+)/',
				'controller' => 'TagController'),
			(object) array(
				'match' => '/search/([a-z0-9-]+)/',
				'controller' => 'SearchController'),
			(object) array(
				'match' => '/search/([a-z0-9-]+)/([0-9]+)/',
				'controller' => 'SearchController'),
			(object) array(
				'match' => '/([a-z-]+)/([a-z0-9-]+)/',
				'controller' => 'PostController'));
	}

}
