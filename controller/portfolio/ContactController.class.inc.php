<?

Loader::load('controller', 'portfolio/DefaultPageController');
Loader::load('utility', array(
	'Validate'));

class ContactController extends DefaultPageController
{

	protected function set_data()
	{
		$form_results = $this->process_form_data();
		
		$this->set_title("Contact Page | Jacob Emerick's Portfolio");
		$this->set_head('description', "Contact page for Jacob Emerick's Portfolio");
		$this->set_head('keywords', 'portfolio, Jacob Emerick, contact, information, request, web development, web programming, print design, freelance');
		
		$this->set_body('body_view', 'Contact');
		$this->set_body('left_side_data', array(
			'title' => "Contact | Jacob Emerick's Portfolio",
			'menu' => $this->get_menu(),
			'home_link' => Loader::getRootURL()));
		$this->set_body('body_data', $form_results);
		
		$this->set_body_view('Page');
	}

	private function process_form_data()
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
      ->setSubject('Portfolio Contact')
      ->setPlainMessage(
        'Name: ' . Request::getPost('name') . "\n" .
        'Email: ' . Request::getPost('email') . "\n" .
        'Message: ' . Request::getPost('message')
      )
      ->send();

			return array(
				'success_message' => "Thank you for your message, ".Request::getPost('name')."! I'll get back to you as soon as possible.");
	}

}
