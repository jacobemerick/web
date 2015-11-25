<?

Loader::load('utility', 'Content');

final class CleanCommentContent extends Content
{

	private static $LINK_PATTERN = '@<a.*href=["\']([^"\']*)["\'].*>(.*)</a>@i';
	private static $BOLD_PATTERN = '@<b.*>(.*)</b>@i';
	private static $ITALIC_PATTERN = '@<i.*>(.*)</i>@i';
	private static $CODE_PATTERN = '@<pre[^>]*>(.*)</pre>@is';

	private static $LINK_REPLACE = '<a href="%s" rel="nofollow" target="_blank">%s</a>';
	private static $BOLD_REPLACE = '<b>%s</b>';
	private static $ITALIC_REPLACE = '<i>%s</i>';
	private static $CODE_REPLACE = '<pre>%s</pre>';

	private static $URL_PATTERN = '@(https?://[a-z0-9\.-]+\.[a-z]{2,6}[^\s]*[^\.,\?\!;\s]+)@i';
	private static $LINE_BREAK_PATTERN = '@([\r\n]+)@';

	private static $LINE_BREAK_REPLACE = '<br />';

	private $replacement_array = array();

	protected function execute()
	{
		$this->process_element(self::$CODE_PATTERN, self::$CODE_REPLACE);
		$this->process_element(self::$LINK_PATTERN, self::$LINK_REPLACE);
		$this->process_element(self::$ITALIC_PATTERN, self::$ITALIC_REPLACE);
		$this->process_element(self::$BOLD_PATTERN, self::$BOLD_REPLACE);
		
		$this->strip_extra_tags();
		
		$this->link_unlinked_urls(self::$URL_PATTERN, self::$LINK_REPLACE);
		$this->add_line_breaks();
		$this->replace_element_patterns();
	}

	private function process_element($pattern, $replace)
	{
		$match_count = preg_match_all($pattern, $this->content, $matches, PREG_SET_ORDER);
		
		if($match_count < 1)
			return;
		
		foreach($matches as $match)
		{
			$full_match = array_shift($match);
			$placeholder = $this->create_placeholder($full_match);
			$full_match_pattern = $this->create_full_match_pattern($full_match);
			
			$this->content = preg_replace($full_match_pattern, $placeholder, $this->content, 1);
			$this->replacement_array[$placeholder] = vsprintf($replace, $match);
		}
	}

	private function create_placeholder($text)
	{
		return md5($text . rand());
	}

	private function create_full_match_pattern($text)
	{
		$pattern = '';
		$pattern .= '@';
		$pattern .= preg_quote($text, '@');
		$pattern .= '@';
		$pattern .= 'i';
		
		return $pattern;
	}

	private function strip_extra_tags()
	{
		$this->content = strip_tags($this->content);
	}

	private function link_unlinked_urls($pattern, $replace)
	{
		$match_count = preg_match_all($pattern, $this->content, $matches, PREG_SET_ORDER);
		
		if($match_count < 1)
			return;
		
		foreach($matches as $match)
		{
			$full_match = array_shift($match);
			$full_match_pattern = $this->create_full_match_pattern($full_match);
			$replace = sprintf($replace, $match[0], $match[0]);
			
			$this->content = preg_replace($full_match_pattern, $replace, $this->content, 1);
		}
	}

	private function add_line_breaks()
	{
		$this->content = preg_replace(self::$LINE_BREAK_PATTERN, self::$LINE_BREAK_REPLACE, $this->content);
	}

	private function replace_element_patterns()
	{
		foreach($this->replacement_array as $key => $replace)
		{
			$this->content = str_replace($key, $replace, $this->content);
		}
	}

}