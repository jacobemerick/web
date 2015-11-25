<?

Loader::load('collector', 'blog/PostCollector');
Loader::load('controller', '/RSSController');
Loader::load('utility', 'Content');

final class BlogPostRSSController extends RSSController
{

	protected function set_header_data()
	{
		$this->setTitle('Jacob Emerick | Blog Feed');
		$this->setLink();
		$this->setDescription('Most recent blog entries of Jacob Emerick, a web developer.');
		
		$this->setAtom('rss/');
		
		$this->setLanguage();
		$this->setCopyright();
		$this->setWebMaster();
		$this->setPubDate();
		$this->setTTL();
	}

	protected function set_body_data()
	{
		$post_result = PostCollector::getMainList(250);
		
		foreach($post_result as $post)
		{
			$this->addItem(
				$post->title,
				"{$post->category}/{$post->path}/",
				Content::instance('FixPhoto', $post->body)->activate(true),
				$post->category,
				date('r', strtotime($post->date)));
		}
	}

}