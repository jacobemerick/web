<?

Loader::load('utility', 'Content');

final class FixUnacceptableCharacterContent extends Content
{

	private static $UNACCEPTABLE_CHARACTER_ARRAY = array(
		'“' => '"',
		'”' => '"');

	protected function execute()
	{
		foreach(self::$UNACCEPTABLE_CHARACTER_ARRAY as $match => $replace)
		{
			if(stristr($this->content, $match))
				$this->content = str_replace($match, $replace, $this->content);
		}
		return;
	}

}