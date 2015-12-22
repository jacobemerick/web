<?

Loader::load('utility', 'Content');

final class MarkupCodeContent extends Content
{

	private static $MARKUP_DELIMITER = '@<pre( rel="(.*?)")?>(.*?)</pre>@s';

	protected function execute($title = '')
	{
		preg_match_all(self::$MARKUP_DELIMITER, $this->content, $matches);
		if(count($matches[1]) == 0)
			return;
		
		foreach($matches[3] as $key => $match)
		{
			$replacement = $match;
			$replacement = $this->wrap_in_list($replacement);
			$replacement = $this->highlight_code($replacement, $matches[2][$key]);
			
			$this->content = str_replace($match, $replacement, $this->content);
		}
		
		return;
	}

	private function wrap_in_list($content)
	{
		$content_array = explode("\n", $content);
		
		foreach($content_array as $key => $row)
		{
			$new_row = ($key % 2 == 0) ? '<li class="even">' : '<li class="odd">';
			$new_row .= '<p>';
			$new_row .= $row;
			$new_row .= '</p>';
			$new_row .= '</li>';
			$content_array[$key] = $new_row;
		}
		
		$content = implode($content_array);
		$content = "<ol>{$content}</ol>";
		return $content;
	}

	private function highlight_code($content, $type)
	{
		switch($type)
		{
			default :
				return $content;
			break;
		}
	}

}