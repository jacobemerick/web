<?

Loader::load('utility', 'cron/Cron');
Loader::load('utility', 'Mail');

final class ErrorCron extends Cron
{

	private $error_files = array();

	private static $test_root = 'C:/xampplite/htdocs/jake';
	private static $live_root = '/home/jpemeric/logs';

	function __construct()
	{
		if(Loader::isLive())
			$handle[] = self::$live_root;
		else
			$handle[] = self::$test_root;
		
		$i = 0;
		while(isset($handle[$i]))
		{
			$path = $handle[$i];
			$fh = opendir($path);
			while(false !== ($file = readdir($fh)))
			{
				if($file != '.' && $file != '..')
				{
					if(is_dir("{$path}/{$file}"))
						$handle[] = "{$path}/{$file}";
					if($file == 'error.log')
						$this->error_files[] = "{$path}/{$file}";
				}
			}
			closedir($fh);
			$i++;
		}
	}

	public function activate()
	{
		$message = '';
		
		if(count($this->error_files) > 0)
		{
			$message .= "Errors from flat-file logs.\n\n";
			foreach($this->error_files as $error_file)
			{
				$contents = file_get_contents($error_file);
				$message .= "{$error_file}\n{$contents}\n\n";
			}
		}
		else
			$message = 'No errors found in the flat-files!';
		
		$mail = new Mail();
		$mail->setToAddress('EMAIL', 'Jacob Emerick');
		$mail->setSubject('Recent Errors for .jacobemerick.com');
		$mail->setMessage($message);
		$mail->send();
		
		if(count($this->error_files) > 0)
		{
			foreach($this->error_files as $error_file)
			{
			//	if(file_exists($error_file))
			//		unlink($error_file);
			}
		}
	}

}
