<?

final class Mail
{

	private $to = array();
	private $subject;
	private $message;
	private $headers = array();

	private static $FROM = "Jacob Emerick's Site <jacob@jacobemerick.com>";

	public function __construct()
	{
        global $config;
		$this->headers['From'] = self::$FROM;
		$this->headers['Reply-To'] = "Jacob <{$config->admin_email}>";
		$this->headers['Bcc'] = "Jacob <{$config->admin_email}>";
	}

	public function setToAddress($email, $person = null)
	{
		if($person)
			$this->to[] = "{$person} <{$email}>";
		else
			$this->to[] = "{$email}";
		return $this;
	}

	public function setSubject($subject)
	{
		$this->subject = $subject;
		return $this;
	}

	public function setMessage($message)
	{
		$this->message = $message;
		return $this;
	}

	public function send()
	{
		if(!Loader::isLive())
		{
			Debugger::logMessage("Email Failed:\n\n{$this->message}");
			return;
		}
		
		$to = implode(", ", $this->to);
		$subject = $this->subject;
		$message = $this->message;
		
		if(empty($to) || empty($subject) || empty($message))
		{
			Debugger::logMessage("Attempted to send an email without all of the required fields.");
			return;
		}
		
		$header = '';
		foreach($this->headers as $key => $value)
		{
			$header .= "{$key}: {$value}\r\n";
		}
		
		mail($to, $subject, $message, $header);
	}

}
