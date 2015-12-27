<?

abstract class Content
{

	protected $original_content;
	protected $content;

	function __construct($content)
	{
		$this->original_content = $content;
		$this->content = $content;
	}

	public function getOriginal()
	{
		return $this->original_content;
	}

	abstract protected function execute();

	public function activate()
	{
		$args = func_get_args();
		call_user_func_array(array($this, 'execute'), $args);
		
		return $this->content;
	}

	public function check()
	{
		$args = func_get_args();
		$return = call_user_func_array(array($this, 'execute'), $args);
		
		return $return;
	}

	public static function instance($class, $content)
	{
		$class_name = "{$class}Content";
		Loader::load('utility', "content/{$class_name}");
		return new $class_name($content);
	}

}
