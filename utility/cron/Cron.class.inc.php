<?

abstract class Cron
{

	private $message;

	abstract public function activate();

	protected function error($value)
	{
		trigger_error("Cron failed: {$value}");
		return false;
	}

}