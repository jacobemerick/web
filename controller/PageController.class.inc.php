<?

Loader::load('utility', 'Header');

abstract class PageController
{

	private static $TRACKING_CODE = 'UA-11745070-1';
	
	protected static $DEPRECATED_BLOGS = array(
		10 => 63,
		55 => 67,
	);

	private $headers;
	private $css_array = array();
	private $font_css_array = array();
	private $js_array = array();

	private $data_array = array();
	private $body_view_array = array();

	protected function set_head_data() {}
	protected function set_body_data() {}
	protected function set_data() {}

	public function __construct()
	{
		$this->set_header_method('sendHTML');
		
		$this->set_head('google_verification', 'sgAISiuoWfK54KXnOfm2oU4vQdad8eyNCQX7LkZ1OxM');
		$this->set_head('bing_verification', 'AF1A4CEA30A7589590E9294C4B512607');
		
		$this->set_body('domain_container', $this->get_domain_container());
		$this->set_body('footer', array(
			'link' => Loader::getRootUrl('site'),
			'anchor' => 'jacobemerick.com',
			'date' => date('Y')));
	}

	protected function get_domain_container()
	{
		$domain_container = new stdclass();
		
		$domain_container->blog = Loader::getRootUrl('blog');
		$domain_container->home = Loader::getRootUrl('home');
		$domain_container->lifestream = Loader::getRootUrl('lifestream');
		$domain_container->map = Loader::getRootUrl('map');
		$domain_container->portfolio = Loader::getRootUrl('portfolio');
		$domain_container->waterfalls = Loader::getRootUrl('waterfalls');
		
		return $domain_container;
	}

    protected function get_recent_activity()
    {
        global $container;
        $activityRepository = new Jacobemerick\Web\Domain\Stream\Activity\MysqlActivityRepository($container['db_connection_locator']);
        $post_result = $activityRepository->getActivities(5);

        $post_array = array();
        foreach($post_result as $row) {
            array_push($post_array, $this->expand_post($row));
        }

        return $post_array;
    }

    protected function expand_post($raw_post, $format = 'short')
    {
        $post = [
            'type' => $raw_post['type'],
            'title' => ($format == 'short') ? $raw_post['message'] : $raw_post['message_long'],
            'date' => $this->get_parsed_date($raw_post['datetime']),
        ];

        if ($format != 'short') {
            $post['url'] = Loader::getRootUrl('lifestream') . "{$raw_post['type']}/{$raw_post['id']}/";

            $metadata = json_decode($raw_post['metadata'], true);
            $post = array_merge($post, $metadata);
        }

        return (object) $post;
    }

	public function activate()
	{
		$this->set_head_data();
		$this->set_body_data();
		$this->set_data();
		
		$this->load_assets();
		
		$headers = $this->headers;
		Header::$headers();
		Loader::load('view', '/Head', $this->data_array['head']);
		foreach($this->body_view_array as $view)
		{
			if(substr($view, 0, 1) == '/')
				Loader::load('view', $view, $this->data_array['body']);
			else
				Loader::load('view', URLDecode::getSite() . '/' . $view, $this->data_array['body']);
		}
        
        if (URLDecode::getSite() == 'waterfalls') {
            Loader::load('view', '/WaterfallFoot');
        } else {
            Loader::load('view', '/Foot', array('tracking_code' => self::$TRACKING_CODE));
        }
		
		if($view == '/404' || $view == '/503')
			exit;
	}

	protected function set_header_method($method)
	{
		$this->headers = $method;
	}

	protected function set_title($value)
	{
		$this->set_head('title', $value);
	}

	protected function set_author($value)
	{
		$this->set_head('author', $value);
	}

	protected function set_description($value)
	{
		$this->set_head('description', $value);
	}

	protected function set_keywords($array)
	{
		$this->set_head('keywords', implode(', ', $array));
	}
	
	protected function set_canonical($url)
	{
		$this->set_head('canonical', $url);
	}

	protected function set_head($set, $value)
	{
		$this->data_array['head'][$set] = $value;
	}

	protected function set_body($set, $value)
	{
		$this->data_array['body'][$set] = $value;
	}

	protected function add_css($file, $version = 1)
	{
		$this->css_array[] = [$file, $version];
	}

	protected function add_js($file)
	{
		$this->js_array[] = $file;
	}

	private function load_assets()
	{
    $css_array = array_map(function ($stylesheet) {
      $path = "/css/{$stylesheet[0]}.css";
      if ($stylesheet[1] > 1) {
        $path .= "?v={$stylesheet[1]}";
      }
      return $path;
    }, $this->css_array);
    $js_array = array_map(function ($script) {
      if (substr($script, 0, 4) == 'http') {
        return $script;
      }
      return "/js/{$script}.min.js";
    }, $this->js_array);
		
		$this->set_head('css_link_array', $css_array);
		$this->set_head('js_link_array', $js_array);
	}

	protected function set_body_view($view)
	{
		$this->body_view_array[] = $view;
	}

	protected function eject()
	{
		if(get_class($this) !== 'Error404Controller')
			Loader::loadNew('controller', '/Error404Controller')->activate();
	}

	protected function unavailable()
	{
		if(get_class($this) !== 'Error503Controller')
			Loader::loadNew('controller', '/Error503Controller')->activate();
	}

	protected function redirect($uri, $method = 301)
	{
		switch($method)
		{
			case 301 :
				if(get_class($this) !== 'Error301Controller')
					Loader::loadNew('controller', '/Error301Controller', array($uri))->activate();
				break;
			case 303 :
				if(get_class($this) !== 'Error303Controller')
					Loader::loadNew('controller', '/Error303Controller', array($uri))->activate();
				break;
		}
	}

	final protected function get_parsed_date($date)
	{
		$parsed_date = new stdclass();
		
		$parsed_date->stamp = date('c', strtotime($date));
		$parsed_date->friendly = date('F j, Y', strtotime($date));
		$parsed_date->elapsed = Content::instance('ElapsedTime', $date)->activate();
		
		return $parsed_date;
	}

	private $comment_errors;
	protected function handle_comment_submit($site_id, $path, $redirect_url, $page_title)
	{
		if(Request::hasPost() && Request::getPost('submit') == 'Submit Comment')
		{
			$parameters = array($site_id, $path, $redirect_url, $page_title);
			$this->comment_errors = Loader::loadNew('module', 'form/CommentSubmitModule', $parameters)->activate();
		}
		
		return;
	}

	protected function get_comment_array($site, $path)
	{
		Loader::load('collector', 'comment/CommentCollector');
		
		$commenter = $this->get_commenter();
		
		$comment_array = array();
		$comment_result = CommentCollector::getCommentsForURL($site, $path, $commenter->id);
		
		foreach($comment_result as $comment)
		{
			$comment_object = new stdclass();
			$comment_object->id = $comment->id;
			$comment_object->body = $comment->body_format;
			$comment_object->date = date("M j, 'y", strtotime($comment->date));
			$comment_object->name = $comment->name;
			$comment_object->url = $comment->url;
			$comment_object->trusted = $comment->trusted;
			
			if($comment->reply == 0 && Request::getPost('type') == $comment->id)
				$comment_object->errors = $this->comment_errors;
			else
				$comment_object->errors = array();
			
			if($comment->reply == 0)
			{
				$comment_object->replies = array();
				$comment_array[$comment->id] = $comment_object;
			}
			else
				$comment_array[$comment->reply]->replies[$comment->id] = $comment_object;
		}
		
		$comment_count = CommentCollector::getCommentCountForURL($site, $path);

    $this->get_comment_array_from_service($site, $path);
		
		return array(
			'comments' => $comment_array,
			'commenter' => $commenter,
			'errors' => $this->comment_errors,
			'comment_count' => $comment_count);
	}

	private function get_commenter()
	{
		Loader::load('collector', 'comment/CommentCollector');

		$commenter = new stdclass();
		
		$commenter->id = 0;
		$commenter->name = '';
		$commenter->email = '';
		$commenter->website = '';

    if (!isset($_COOKIE['commenter'])) {
      return $commenter;
    }

		$commenter_cookie_value = json_decode($_COOKIE['commenter']);
		
		if($commenter_cookie_value === NULL)
			return $commenter;
		
		if(!isset($commenter_cookie_value->name) || !isset($commenter_cookie_value->email))
			return $commenter;
		
		$commenter_object = CommentCollector::getCommenterByFields($commenter_cookie_value->name, $commenter_cookie_value->email, (isset($commenter_cookie_value->website) ? $commenter_cookie_value->website : ''));
		
		if($commenter_object === NULL)
			return $commenter;
		
		$commenter->id = $commenter_object->id;
		$commenter->name = $commenter_object->name;
		$commenter->email = $commenter_object->email;
		$commenter->website = $commenter_object->url;
		
		return $commenter;
	}

    protected function get_comment_array_from_service($site, $path)
    {
        global $config;
        $configuration = new Jacobemerick\CommentService\Configuration();
        $configuration->setUsername($config->comments->user);
        $configuration->setPassword($config->comments->password);
        $configuration->addDefaultHeader('Content-Type', 'application/json');
        $configuration->setHost($config->comments->host);
        $configuration->setCurlTimeout($config->comments->timeout);

        $client = new Jacobemerick\CommentService\ApiClient($configuration);
        $api = new Jacobemerick\CommentService\Api\DefaultApi($client);

        $start = microtime(true);
        try {
            $comment_response = $api->getComments(
                1,
                null,
                '-date',
                'blog.jacobemerick.com',
                $path // todo needs category
            );
        } catch (Exception $e) {
            global $container;
            $container['logger']->warning("CommentService | Path | {$e->getMessage()}");
            return;
        }
 
        $elapsed = microtime(true) - $start;
        global $container;
        $container['logger']->info("CommentService | Path | {$elapsed}");

        // todo this is for sidebar, not post
        $array = array();
        foreach($comment_response as $comment)
        {
            $body = $comment->getBody();
            $body = Content::instance('CleanComment', $body)->activate();
            $body = strip_tags($body);

            $comment_obj = new stdclass();
            $comment_obj->description = Content::instance('SmartTrim', $body)->activate(30);
            $comment_obj->commenter = $comment->getCommenter()->getName();
            $comment_obj->link = "{$comment->getUrl()}/#comment-{$comment->getId()}";
            $array[] = $comment_obj;
        }
        return $array;
    }

}
