<?

Loader::load('controller', '/PageController');
Loader::load('utility', 'Content');

abstract class DefaultPageController extends PageController
{

	private static $RECENT_COMMENT_COUNT = 10;
	private static $MINIMUM_TAG_COUNT = 10;
	protected static $LENGTH_OF_TRIMMED_POST = 300;

	protected static $BLOG_SITE_ID = 2;

	private static $INTRODUCTION_IMAGE_PATTERN = '<img src="/photo/%s/%s-size-%s.jpg" height="%d" width="%d" alt="%s" />';

	protected function set_head_data()
	{
    $this->set_head('rss_link', [
      'title' => 'Jacob Emerick Blog Feed',
      'url' => '/rss.xml'
    ]);
    $this->set_head('rss_comment_link', [
      'title' => 'Jacob Emerick Blog Comment Feed',
      'url' => '/rss-comments.xml'
    ]);
		
		$this->add_css('normalize');
		$this->add_css('blog');
	}

	protected function get_introduction()
	{
		return;
	}

	protected function get_introduction_image($id)
	{
		Loader::load('collector', 'image/PhotoCollector');
		$photo_result = PhotoCollector::getRow($id);
		
		if($photo_result == null)
			return;
		
		$name = $photo_result->name;
		$category = $photo_result->category;
		$size = 'medium';
		$height = 375;
		$width = 500;
		$description = $photo_result->description;
		
		return sprintf(self::$INTRODUCTION_IMAGE_PATTERN, $category, $name, $size, $height, $width, $description);
	}

	protected function set_body_data()
	{
		$this->set_body('introduction', $this->get_introduction());
		$this->set_body('right_side', $this->get_right_side());
		$this->set_body('activity_array', $this->get_recent_activity());
		
		$this->set_body_view('Page');
	}

	final protected function format_post($post, $trim = false)
	{
		$post_object = new stdclass();
		
		$post_object->title = $post['title'];
		$post_object->path = "/{$post['category']}/{$post['path']}/";
		$post_object->category = ucwords(str_replace('-', ' ', $post['category']));
		$post_object->category_link = "/{$post['category']}/";
		$post_object->tags = $this->get_tags_for_post($post);
		$post_object->image = Content::instance('FetchFirstPhoto', $post['body'])->activate(false, 'small');
		$post_object->body = $this->get_body_for_post($post, $trim);
		$post_object->date = $this->get_parsed_date($post['date']);

		return $post_object;
	}

	final private function get_tags_for_post($post)
	{
        global $container;
        $repository = new Jacobemerick\Web\Domain\Blog\Tag\MysqlTagRepository($container['db_connection_locator']);
        $tag_result = $repository->getTagsForPost($post['id']);

        $tag_array = array();
		foreach($tag_result as $tag)
		{
			$tag_object = new stdclass();
			$tag_object->name = $tag['tag'];
			$tag_object->link = Content::instance('URLSafe', "/tag/{$tag['tag']}/")->activate();
			$tag_array[] = $tag_object;
		}
		return $tag_array;
	}

	final private function get_body_for_post($post, $trim)
	{
		$body = $post['body'];
		
		if($trim)
			$body = Content::instance('SmartTrim', $body)->activate(self::$LENGTH_OF_TRIMMED_POST);
		
		$body = Content::instance('FixPhoto', $body)->activate(false, 'standard');
		$body = Content::instance('MarkupCode', $body)->activate();
		
		return $body;
	}

	final protected function get_right_side()
	{
		$side_array = array();
		$side_array['tags'] = $this->get_tag_cloud();
		$side_array['comments'] = $this->get_comments();
		return $side_array;
	}

	final private function get_tag_cloud()
	{
        global $container;
        $repository = new Jacobemerick\Web\Domain\Blog\Tag\MysqlTagRepository($container['db_connection_locator']);
        $tag_result = $repository->getTagCloud();
		
		$maximum_tag_count = $this->get_maximum_tag_count($tag_result);
		
		$cloud_array = array();
		foreach($tag_result as $tag)
		{
			if($tag['count'] < self::$MINIMUM_TAG_COUNT)
				continue;
			
			$tag_object = new stdclass();
			$tag_object->name = $tag['tag'];
			$tag_object->link = Content::instance('URLSafe', "/tag/{$tag['tag']}/")->activate();
			$tag_object->scalar = floor(($tag['count'] - 1) * (9 / ($maximum_tag_count - self::$MINIMUM_TAG_COUNT)));
			$cloud_array[] = $tag_object;
		}
		
		return $cloud_array;
	}

	final private function get_maximum_tag_count($tag_result)
	{
		$maximum = 1;
		
		foreach($tag_result as $tag)
		{
			if($tag['count'] > $maximum)
				$maximum = $tag['count'];
		}
		return $maximum;
	}

    final private function get_comments()
    {
        global $container;
        $repository = new Jacobemerick\Web\Domain\Comment\Comment\ServiceCommentRepository($container['comment_service_api']);
        $start = microtime(true);
        try {
            $comment_response = $repository->getComments(
                'blog.jacobemerick.com',
                null,
                1,
                self::$RECENT_COMMENT_COUNT,
                '-date'
            );
        } catch (Exception $e) {
            $container['logger']->warning("CommentService | Sidebar | {$e->getMessage()}");
            return;
        }
 
        $elapsed = microtime(true) - $start;
        global $container;
        $container['logger']->info("CommentService | Sidebar | {$elapsed}");

        $array = array();
        foreach($comment_response as $comment)
        {
            $body = Content::instance('CleanComment', $comment['body'])->activate();
            $body = strip_tags($body);

            $comment_obj = new stdclass();
            $comment_obj->description = Content::instance('SmartTrim', $body)->activate(30);
            $comment_obj->commenter = $comment['commenter']['name'];
            $comment_obj->link = $comment['url'];
            $array[] = $comment_obj;
        }
        return $array;
    }
}
