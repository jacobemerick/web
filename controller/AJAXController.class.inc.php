<?php

Loader::load('utility', array(
	'Header',
	'Request'));

abstract class AJAXController
{

	private static $RESPONSE_HEADER = 'sendJSON';

	private $response = array();

	abstract protected function set_data();

	function __construct()
	{
		Debugger::hide();
	}

	public function activate()
	{
		call_user_func(array('Header', self::$RESPONSE_HEADER));
		
		$this->set_data();
		echo $this->response_as_json();
	}

	protected function set_response($message, $type = 'internal')
	{
		switch($type)
		{
			case 'internal' :
				$this->response['internal'] = $message;
			break;
			case 'error' :
				$this->response['error'] = $message;
			default :
				$this->response[$type] = $message;
			break;
		}
	}

	protected function fail_response($message)
	{
		$this->set_response($message, 'error');
		return false;
	}

	protected function eject($message)
	{
		$this->fail_response($message);
		echo $this->response_as_json();
		exit();
	}

	private function response_as_json()
	{
		return json_encode($this->response);
	}

}

?>