<?

Loader::load('utility', array(
	'Asset',
	'Header'));

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
		
		Loader::loadInstance('utility', 'Database');
		if(Database::isConnected() === false)
			$this->unavailable();
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
		Loader::load('collector', 'stream/ActivityCollector');
		
		$post_array = array();
		$post_result = ActivityCollector::getRecent();
		
		foreach($post_result as $row)
		{
			$post_array[] = $this->expand_post($row);;
		}
		
		return $post_array;
	}

	protected function expand_post($raw_post, $format = 'short')
	{
		Loader::load('collector', array(
			'stream/BlogCollector',
			'stream/BookCollector',
			'stream/DistanceCollector',
			'stream/HuluCollector',
			'stream/TwitterCollector',
			'stream/YouTubeCollector'));
		Loader::load('utility', 'Content');
		
		$post = new stdclass();
		
		switch($raw_post->type)
		{
			case 'blog' :
				$row = BlogCollector::getRow($raw_post->type_id);
				
				$post->type = 'blog';
				
				$category = str_replace('-', ' ', $row->category);
				$post->title = "Blogged about {$category}: <a href=\"{$row->url}\">{$row->title}</a>.";
				$post->comments = $row->comments;
				
				if($format == 'full')
					$post->image = Content::instance('FetchFirstPhoto', $row->body)->activate(false, 'standard');
			break;
			case 'book' :
				$row = BookCollector::getRow($raw_post->type_id);
				
				$post->type = 'book';
				$post->title = "Just finished reading {$row->title} by {$row->author}.";
				
				if($format == 'full')
					$post->image = "<img alt=\"{$row->title} by {$row->author}\" src=\"{$row->image}\" />";
			break;
			case 'distance' :
				$row = DistanceCollector::getRow($raw_post->type_id);
				
				$post->type = 'distance';
				if($row->type == 'running')
				{
					$post->title = "Ran {$row->distance} miles and felt {$row->felt}.";
					if(strlen($row->message) > 0)
						$post->title .= " Afterwards, I was all like '{$row->message}'.";
				}
				else if($row->type == 'hiking')
				{
					$post->title = "Hiked {$row->distance} miles and felt {$row->felt}.";
					if(strlen($row->title) > 0)
						$post->title .= " I was hiking up around the {$row->title} area.";
				}
                else if ($row->type == 'walking') {
                    $post->title = "Walked {$row->distance} miles and felt {$row->felt}.";
                }
			break;
			case 'hulu' :
				$row = HuluCollector::getRow($raw_post->type_id);
				
				$post->type = 'hulu';
				$post->title = "Watched {$row->title} on Hulu.";
			break;
			case 'twitter' :
				$row = TwitterCollector::getRow($raw_post->type_id);
				
				$post->type = 'twitter';
				
				if($format == 'full')
					$post->title = $row->text_formatted_full;
				else
					$post->title = $row->text_formatted;
				
				$post->retweets = ($row->is_retweet == 0) ? $row->retweets : 0;
				$post->favorites = ($row->is_retweet == 0) ? $row->favorites : 0;
			break;
			case 'youtube' :
				$row = YouTubeCollector::getRow($raw_post->type_id);
				
				$post->type = 'youtube';
				
				if($format == 'full')
					$post->title = "Favorited {$row->title} by {$row->author} on YouTube.";
				else
					$post->title = "Favorited <a href=\"http://www.youtube.com/watch?feature=player_embedded&v={$row->video_id}\" rel=\"nofollow\" target=\"_blank\" title=\"{$row->content}\">{$row->title}</a> by {$row->author} on YouTube.";
				
				if($format == 'full')
					$post->embed_code = "<iframe src=\"http://www.youtube.com/embed/{$row->video_id}?rel=0\" frameborder=\"0\" allowfullscreen></iframe>";
			break;
		}
		
		$post->date = $this->get_parsed_date($row->date);
		
		$post->url = '';
		$post->url .= Loader::getRootUrl('lifestream');
		$post->url .= $raw_post->type;
		$post->url .= '/';
		$post->url .= $raw_post->id;
		$post->url .= '/';
		
		return $post;
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

	protected function add_css($file)
	{
		$this->css_array[] = $file;
	}

	protected function add_js($file)
	{
		$this->js_array[] = $file;
	}

	private function load_assets()
	{
		$css_array = $this->css_array;
		$css_array = Asset::getCSS($css_array);
		
		$js_array = array();
		
		if(count($this->js_array) > 0)
			$js_array = array_merge($js_array, $this->js_array);
		
		if(count($js_array) > 0)
			$js_array = Asset::getJS($js_array);
		
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
		
		return array(
			'comments' => $comment_array,
			'commenter' => $commenter,
			'errors' => $this->comment_errors,
			'comment_count' => $comment_count);
	}

	private function get_commenter()
	{
		Loader::load('collector', 'comment/CommentCollector');
		Loader::load('utility', 'Cookie');
		
		$commenter = new stdclass();
		
		$commenter->id = 0;
		$commenter->name = '';
		$commenter->email = '';
		$commenter->website = '';
		
		$commenter_cookie = Cookie::instance('Commenter');
		if(!$commenter_cookie->exists())
			return $commenter;
		
		$commenter_cookie_value = $commenter_cookie->getValue();
		$commenter_cookie_value = json_decode($commenter_cookie_value);
		
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

}
