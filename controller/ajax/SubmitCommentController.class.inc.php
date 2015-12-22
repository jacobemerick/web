<?

Loader::load('collector', array(
	'blog/PostCollector',
	'comment/CommentCollector'));
Loader::load('controller', '/AJAXController');
Loader::load('utility', array(
	'Database',
	'Mail',
	'Validate'));

final class SubmitCommentController extends AJAXController
{

	protected function set_data()
	{
		if(!Validate::checkRequest('post', 'name', 'name'))
			return $this->fail_response('You must include a valid name.');
		if(!Validate::checkRequest('post', 'email', 'email'))
			return $this->fail_response('You must include a valid email.');
		if(Request::getPost('website') && !Validate::checkRequest('post', 'website', 'url'))
			return $this->fail_response('Please include a valid website.');
		if(!Validate::checkRequest('post', 'comment', 'string'))
			return $this->fail_response('You must enter a comment.');
		if(!Validate::checkRequest('post', 'save', 'boolean'))
			return $this->fail_response('You entered an invalid save request.');
		if(!Validate::checkRequest('post', 'notify', 'boolean'))
			return $this->fail_response('You entered an invalid notify request.');
		if(Request::getPost('reply') && !Validate::checkRequest('post', 'reply', 'integer'))
			return $this->fail_response('You entered an invalid reply value.');
		
		$referer_url = Request::getServer('HTTP_REFERER');
		$url = explode('/', $referer_url);
		$url = array_slice($url, -2, 1);
		$url = array_pop($url);
		$post = PostCollector::getPostByURI($url);
		
		if($post === null)
			return $this->fail_response('There seems to be a problem with this page.', 'error');
		
		$commentpage_result = CommentCollector::getCommentPageByURL($post->path, 2);
		if($commentpage_result === null)
		{
			$query = "INSERT INTO `jpemeric_comment`.`comment_page` (`site_id`, `url`) VALUES ('%d', '%s')";
			
			$site_id = 2;
			$url = $post->path;
			
			$query = sprintf($query, $site_id, $url);
			Database::execute($query);
			$commentpage_id = Database::lastInsertID();
		}
		else
			$commentpage_id = $commentpage_result->id;
		
		$save = (Request::getPost('save') == 'true') ? 1 : 0;
		
		$commenter_result = CommentCollector::getCommenterByFields(Request::getPost('name'), Request::getPost('email'), Request::getPost('website'));
		if($commenter_result === null)
		{
			$query = "INSERT INTO `jpemeric_comment`.`commenter` (`name`,`email`,`url`,`save`) VALUES ('%s','%s','%s','%s')";
			
			$name = Database::escape(Request::getPost('name'));
			$email = Database::escape(Request::getPost('email'));
			$website = Database::escape(Request::getPost('website'));
			
			$query = sprintf($query, $name, $email, $website, $save);
			Database::execute($query);
			$commenter_id = Database::lastInsertID();
		}
		else
		{
			if($commenter_result->save !== $save)
			{
				$query = "UPDATE `jpemeric_comment`.`commenter` SET `save` = '%s' WHERE `id` = '%d'";
				
				$query = sprintf($query, $save, $commenter_result->id);
				Database::execute($query);
			}
			$commenter_id = $commenter_result->id;
		}
		
		$comment_result = CommentCollector::getCommentByBody(Request::getPost('comment'));
		if($comment_result === null)
		{
			$query = "INSERT INTO `jpemeric_comment`.`comment` (`body`) VALUES ('%s')";
			
			$body = Database::escape(Request::getPost('comment'));
			
			$query = sprintf($query, $body);
			Database::execute($query);
			$comment_id = Database::lastInsertID();
		}
		else
			$comment_id = $comment_result->id;
		
		$query = "INSERT INTO `jpemeric_comment`.`comment_meta` (`commenter_id`,`comment_id`,`reply`,`notify`,`commentpage_id`,`date`,`display`) VALUES ('%d','%d','%d','%d','%d','%s','%d')";
		
		$reply = Database::escape(Request::getPost('reply'));
		$notify = (Request::getPost('notify') == 'true') ? 1 : 0;
		$date = date('Y-m-d H:i:s');
		$display = 1;
		
		$query = sprintf($query, $commenter_id, $comment_id, $reply, $notify, $commentpage_id, $date, $display);
		Database::execute($query);
		$commentmeta_id = Database::lastInsertID();

		global $config;
		$email_recipient_array[$config->admin_email] = array(
			'email' => $config->admin_email,
			'name' => 'Jacob Emerick');
		
		$notification_result = CommentCollector::getNotificationForPage($commentpage_id);
		
		foreach($notification_result as $notification_row)
		{
			if($notification_row->email == $email)
				continue;
			
			$email_recipient_array[$notification_row->email] = array(
				'email' => $notification_row->email,
				'name' => $notification_row->name);
		}
		
		$message = "Hello!\nThere has been a new post on the post '{$post->title}' at Jacob Emerick's Blog. You have chosen to be notified of it - please reply to {$config->admin_email} if you do would like to be removed from these notifications.\n\nOn " . date('F j, Y g:i a') . ", " . Request::getPost('name') . " commented...\n" . Request::getPost('comment') . "\n\nVisit {$referer_url}#comments to see and reply to all the comments on this post.\nThank you!";
		foreach($email_recipient_array as $email_recipient)
		{
			$mail = new Mail();
			$mail->setToAddress($email_recipient['email'], $email_recipient['name']);
			$mail->setSubject("New Comment on Jacob Emerick's Blog");
			$mail->setMessage($message);
			$mail->send();
		}
		
		if(Request::getPost('save') == true)
		{
			/*
			$cookie = new Cookie('jpe_commenter');
			
			$commenter_obj = Finder::instance('Commenter')
				->setNameFilter(Request::getPost('name'))
				->setEmailFilter(Request::getPost('email'))
				->setURLFilter(Request::getPost('website'))
				->setSaveFilter(Request::getPost('save') == true)
				->getCommenter();
			
			$cookie->setValue($commenter_obj->getID());
			$cookie->setExpire(strtotime('+30 days'));
			$cookie->setPath('/');
			$cookie->save();
			*/
		}
		
		$this->set_response('success');
		
		return;
	}

}

?>
