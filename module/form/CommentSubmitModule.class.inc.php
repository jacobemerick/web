<?

Loader::load('collector', 'comment/CommentCollector');

Loader::load('utility', array(
	'Content',
	'Cookie',
	'Request',
	'Validate'));

final class CommentSubmitModule
{

	private $site;
	private $path;
	private $full_path;
	private $page_title;

	public function __construct($site, $path, $full_path, $page_title)
	{
		$this->site = $site;
		$this->path = $path;
		$this->full_path = $full_path;
		$this->page_title = $page_title;
	}

	public function activate()
	{
		if(!Request::hasPost())
			return false;
		if(!Request::getPost('submit') == 'Submit Comment')
			return false;
		
		$errors = $this->fetch_errors();
		if(count($errors) > 0)
			return $errors;
		if(Request::getPost('catch') !== '')
			return false;
		
		$page_id = $this->save_comment_page();
		$commenter_id = $this->save_commenter();
		$comment_id = $this->save_comment();
		
		$comment_meta_id = $this->save_comment_meta($commenter_id, $comment_id, $page_id);
		
		$this->send_notifications($page_id);
		$this->redirect_to_comment($comment_meta_id);
	}

	private function fetch_errors()
	{
		$errors = array();
		if(!Validate::checkRequest('post', 'name', 'name'))
			$errors['name'] = 'You must include a valid name';
		if(!Validate::checkRequest('post', 'email', 'email'))
			$errors['email'] = 'You must include a valid email';
		if(Request::getPost('website') && !Validate::checkRequest('post', 'website', 'url'))
			$errors['website'] = 'Please enter a valid website';
		if(!Validate::checkRequest('post', 'comment', 'string'))
			$errors['comment'] = 'You must enter a comment';
		if(Request::getPost('notify') && Request::getPost('notify') != 'check')
			$errors['notify'] = 'You entered an invalid notify request';
		if(Request::getPost('reply') && !Validate::checkRequest('post', 'reply', 'integer'))
			$errors['reply'] = 'You entered an invalid reply request';
		
		return $errors;
	}

	private function save_comment_page()
	{
		$page_result = CommentCollector::getCommentPageByURL($this->path, $this->site);
		if($page_result !== null)
			return $page_result->id;
		
		$query = "INSERT INTO `jpemeric_comment`.`comment_page` (`site`, `path`) VALUES ('%d', '%s')";
		$query = sprintf($query, $this->site, $this->path);
		Database::execute($query);
		
		return Database::lastInsertID();
	}

	private function save_commenter()
	{
		$cookie_value = array(
			'name' => Request::getPost('name'),
			'email' => Request::getPost('email'));
		
		if(Request::getPost('website') != '')
			$cookie_value['website'] = Request::getPost('website');
		
		$cookie_value = json_encode($cookie_value);
		
		Cookie::instance('Commenter')
			->setValue($cookie_value)
			->save();
		
		$commenter_result = CommentCollector::getCommenterByFields(Request::getPost('name'), Request::getPost('email'), Request::getPost('website'));
		if($commenter_result !== null)
			return $commenter_result->id;
		
		$query = "INSERT INTO `jpemeric_comment`.`commenter` (`name`,`email`,`url`) VALUES ('%s','%s','%s')";
		
		$name = Database::escape(Request::getPost('name'));
		$email = Database::escape(Request::getPost('email'));
		$website = Database::escape(Request::getPost('website'));
		
		$query = sprintf($query, $name, $email, $website);
		Database::execute($query);
		return Database::lastInsertID();
	}

	private function save_comment()
	{
		$comment_result = CommentCollector::getCommentByBody(Request::getPost('comment'));
		if($comment_result !== null)
			return $comment_result->id;
		
		$query = "INSERT INTO `jpemeric_comment`.`comment` (`body`, `body_format`) VALUES ('%s', '%s')";
		
		$body = Database::escape(Request::getPost('comment'));
		
		$body_format = Request::getPost('comment');
		$body_format = Content::instance('CleanComment', $body_format)->activate();
		$body_format = Database::escape($body_format);
		
		$query = sprintf($query, $body, $body_format);
		Database::execute($query);
		return Database::lastInsertID();
	}

	private function save_comment_meta($commenter, $comment, $page)
	{
		$query = "INSERT INTO `jpemeric_comment`.`comment_meta` (`commenter`,`comment`,`reply`,`notify`,`comment_page`,`date`,`display`) VALUES ('%d','%d','%d','%d','%d','%s','%d')";
		
		$reply = Database::escape(Request::getPost('type'));
		if($reply == 'new')
			$reply = 0;
		// else check to make sure value is legit
		
		$notify = (Request::getPost('notify') == 'check') ? 1 : 0;
		$date = date('Y-m-d H:i:s');
		$display = 1;
		
		$query = sprintf($query, $commenter, $comment, $reply, $notify, $page, $date, $display);
		Database::execute($query);
		return Database::lastInsertID();
	}

	private function send_notifications($page)
	{
		Loader::load('utility', 'Mail');
		
		$email_recipient_array = array();
		$email_recipient_array['EMAIL'] = array(
			'email' => 'EMAIL',
			'name' => 'Jacob Emerick');
		
		$commenter_result = CommentCollector::getCommenterByFields(Request::getPost('name'), Request::getPost('email'), Request::getPost('website'));
		
		if($commenter_result->trusted == 1)
		{
			$notification_result = CommentCollector::getNotificationForPage($page);
			
			foreach($notification_result as $notification_row)
			{
				if($notification_row->email == Request::getPost('email'))
					continue;
				
				$email_recipient_array[$notification_row->email] = array(
					'email' => $notification_row->email,
					'name' => $notification_row->name);
			}
		}
        
        $site = URLDecode::getSite();
        
        if ($site == 'blog') {
            $message = "Hello!\nThere has been a new comment on the post '{$this->page_title}' at Jacob Emerick's Blog. You have chosen to be notified of it - please reply to jacob@jacobemerick.com if you would like to be removed from these notifications.\n\nOn " . date('F j, Y g:i a') . ", " . Request::getPost('name') . " commented...\n" . Request::getPost('comment') . "\n\nVisit {$this->full_path}#comments to see and reply to all the comments on this post.\nThank you!";
        } else if ($site == 'waterfalls') {
            $message = "Hello!\nThere has been a new comment on the page '{$this->page_title}' at Waterfalls of the Keweenaw. You have chosen to be notified of it - please reply to jacob@jacobemerick.com if you would like to be removed from these notifications.\n\nOn " . date('F j, Y g:i a') . ", " . Request::getPost('name') . " commented...\n" . Request::getPost('comment') . "\n\nVisit {$this->full_path}#comments to see and reply to all the comments on this post.\nThank you!";
        }
        
		foreach($email_recipient_array as $email_recipient)
		{
			$mail = new Mail();
			$mail->setToAddress($email_recipient['email'], $email_recipient['name']);
            
            if ($site == 'blog') {
                $mail->setSubject("New Comment on Jacob Emerick's Blog");
            } else if ($site == 'waterfalls') {
                $mail->setSubject("New Comment on Waterfalls of the Keweenaw");
            }
            
			$mail->setMessage($message);
			$mail->send();
		}
	}

	private function redirect_to_comment($comment_id)
	{
		$url = '';
		$url .= $this->full_path;
		$url .= "#comment-{$comment_id}";
		
		Loader::loadNew('controller', 'Error303Controller', array($url))->activate();
		exit;
	}

}
