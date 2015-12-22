<?php

use Jacobemerick\Web\Domain\Blog\Post\MysqlPostRepository;

Loader::load('controller', 'home/DefaultPageController');
Loader::load('utility', 'Content');

final class HomeController extends DefaultPageController
{

	private static $TITLE = "Jacob Emerick's Home | Web Developer, Hiker, Innovator";
	private static $DESCRIPTION = 'Home page for Jacob Emerick, with links to his blog, waterfall site, and other side projects';

	private static $KEYWORD_ARRAY = array(
		'Jacob Emerick',
		'jacobemerick',
		'jpemeric',
		'home',
		'web developer',
		'hiker',
		'application programmer',
		'innovator');

	private static $POST_LENGTH_SHORT = 160;
	private static $POST_LENGTH_LONG = 240;

	protected function set_head_data()
	{
		$this->set_title(self::$TITLE);
		$this->set_description(self::$DESCRIPTION);
		$this->set_keywords(self::$KEYWORD_ARRAY);
		
		parent::set_head_data();
	}

	protected function set_body_data()
	{
		$this->set_body('post_array', $this->get_recent_posts());
		$this->set_body_view('Home');
		
		parent::set_body_data();
	}

	private function get_recent_posts()
	{
    global $container;
    $postRepository = new MysqlPostRepository($container['db_connection_locator']);
    $recentPosts = $postRepository->getActivePosts(3);

		$recent_post_array = array();
		foreach($recentPosts as $postResult)
		{
			$post = new stdclass();
			$post->title = $postResult['title'];
			$post->url = Loader::getRootUrl('blog') . "{$postResult['category']}/{$postResult['path']}/";
			$post->category = ucwords(str_replace('-', ' ', $postResult['category']));
			$post->thumb = Content::instance('FetchFirstPhoto', $postResult['body'])->activate();
			$post->body = Content::instance('SmartTrim', $postResult['body'])->activate(($post->thumb !== '') ? self::$POST_LENGTH_SHORT : self::$POST_LENGTH_LONG);
						
			$recent_post_array[] = $post;
		}
		return $recent_post_array;
	}

}
