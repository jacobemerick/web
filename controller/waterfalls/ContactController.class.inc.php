<?

Loader::load('controller', 'waterfalls/DefaultPageController');

final class ContactController extends DefaultPageController
{

	private static $TITLE = 'Contact Jacob Emerick | Waterfalls of the Keweenaw';
	private static $DESCRIPTION = 'Contact page to reach Jacob Emerick by email or social networks';

	private static $KEYWORD_ARRAY = array(
		'contact',
		'email',
		'waterfalls',
		'Jacob Emerick');

	protected function set_head_data()
	{
		$this->set_title(self::$TITLE);
		$this->set_description(self::$DESCRIPTION);
		$this->set_keywords(self::$KEYWORD_ARRAY);
		
		parent::set_head_data();
	}

	protected function set_body_data()
	{
		$this->set_body('form_container', $this->process_form());
		$this->set_body('view', 'Contact');
		
		parent::set_body_data();
	}

	private function process_form()
	{
		if(!Request::hasPost() || Request::getPost('submit') != 'Send Message!')
			return (object) array('display' => 'normal');
		
		Loader::load('utility', 'Validate');
		$error_result = array();
		if(!Validate::checkRequest('post', 'name', 'string'))
			$error_result['name'] = 'please enter your name';
		if(!Validate::checkRequest('post', 'email', 'string'))
			$error_result['email'] = 'please enter a valid email';
		if(!Validate::checkRequest('post', 'message', 'string'))
			$error_result['message'] = 'please write a message';
		
		$values = (object) array(
			'name' => Request::getPost('name'),
			'email' => Request::getPost('email'),
			'message' => Request::getPost('message'));
		
		if(count($error_result) > 0)
		{
			return (object) array(
				'display' => 'error',
				'messages' => $error_result,
				'values' => $values);
		}
		
        global $config;
		$mail = Loader::loadNew('utility', 'Mail');
		$mail->setToAddress($config->admin_email, 'Jacob Emerick');
		$mail->setSubject('Waterfall Site Contact');
		
		$message = '';
		$message .= "Name: {$values->name}\n";
		$message .= "Email: {$values->email}\n";
		$message .= "Message: {$values->message}";
		
		$mail->setMessage($message);
		$mail->send();
		
		return (object) array('display' => 'success');
	}

}
