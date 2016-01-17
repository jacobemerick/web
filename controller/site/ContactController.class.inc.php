<?

Loader::load('controller', 'site/DefaultPageController');
Loader::load('utility', array(
	'Validate'));

final class ContactController extends DefaultPageController
{

	protected function set_head_data()
	{
		$this->set_title("Contact Form for Jacob Emerick's Sites");
		$this->set_description("Want to reach out to Jacob Emerick with questions or concerns? Well, then here's a handy contact form for you that will connect you with the man himself.");
		$this->set_keywords(array('contact', 'webmaster', 'support', 'help', 'Jacob Emerick'));
		
		parent::set_head_data();
	}

	protected function set_body_data()
	{
		parent::set_body_data();
		
		$this->set_body('top_data', array('title' => 'Contact Me'));
		
		$this->set_body('body_data', $this->get_form_results());
		$this->set_body('body_view', 'Contact');
	}

	private function get_form_results()
	{
		if(!Request::hasPost())
			return array();
		
		if(!Validate::checkRequest('post', 'name', 'string'))
			$error_message['name'] = 'Please enter a value for your name.';
		if(!Validate::checkRequest('post', 'email', 'string'))
			$error_message['email'] = 'Please enter a valid email address.';
		if(!Validate::checkRequest('post', 'message', 'string'))
			$error_message['message'] = 'Please enter a message.';
		
		if(!empty($error_message))
		{
			return array(
				'error_message' => $error_message,
				'value' => Request::getPost());
		}

    global $container;
    $sent = $container['mail']
      ->addTo($container['config']->admin_email)
      ->setSubject('Site Contact')
      ->setPlainMessage(
        'Name: ' . Request::getPost('name') . "\n" .
        'Email: ' . Request::getPost('email') . "\n" .
        'Message: ' . Request::getPost('message')
      )
      ->send();

		return array(
			'success_message' => "Thank you for your message, " . Request::getPost('name') . "! I'll get back to you as soon as possible.");
	}

}
