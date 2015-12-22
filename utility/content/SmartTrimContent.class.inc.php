<?

Loader::load('utility', 'Content');

class SmartTrimContent extends Content
{

	private static $EXCLUDE_TAGS = array(
		'a',
		'div',
		'h4',
		'pre');
	private static $INCLUDE_TAGS = array(
		'li',
		'ol',
		'p',
		'ul');
	private static $PHOTO_PLACEHOLDER_MATCH = '/{{photo="(.*)"}}/';
	private static $HTML_TAG_PATTERN = '/<[^>]+>/';
	private static $CUT_MARKER = '/*/ CUT HERE /*/';
	private static $RIGHT_BRACKET = '>';
	private static $LEFT_BRACKET = '<';
	private static $ETC = '&hellip;';

	private $is_trimmed;

	protected function execute()
	{
		$args = func_get_args();
		if(count($args) < 1)
		{
			trigger_error('Someone called SmartTrimContent w/o defining a length... bad!');
			return;
		}
		
		if(count($args) == 2)
			$etc = $args[1];
		else
			$etc = self::$ETC;
		
		$length = $args[0];
		
		if($length < strlen($this->content))
			$this->trim_string($length);
        else
            $etc = '';
		$this->check_exclude_tags();
		$this->close_tags($etc);
	}

	private function trim_string($length)
	{
		$content = $this->trim_html_string($this->content, $length);
		
		$last_right_bracket_position = strripos($content, self::$RIGHT_BRACKET);
		$last_left_bracket_position = strripos($content, self::$LEFT_BRACKET);
		if($last_left_bracket_position > $last_right_bracket_position)
			$content = substr($content, 0, $last_left_bracket_position);
		$content = trim($content);
		
		$this->content = $content;
		$this->is_trimmed = true;
	}

	private function trim_html_string($content, $length)
	{
		$content = preg_replace(self::$PHOTO_PLACEHOLDER_MATCH, '', $content);
		preg_match_all(self::$HTML_TAG_PATTERN, $content, $matches, PREG_OFFSET_CAPTURE);
		$content = strip_tags($content);
		
		$content = wordwrap($content, $length, self::$CUT_MARKER);
		$content = explode(self::$CUT_MARKER, $content);
		$content = current($content);
		
		$max_length = $length;
		foreach($matches[0] as $match)
		{
			$max_length += strlen($match[0]);
			if($max_length <= $match[1])
				break;
			
			$content = substr($content, 0, $match[1]) . $match[0] . substr($content, $match[1]);
		}
		
		if(substr($content, -7) == '</p><p>')
			$content = substr($content, 0, -7);
		
		return $content;
	}

	private function check_exclude_tags()
	{
		$content = $this->content;
		$tags_preg = $this->get_tags_preg(self::$EXCLUDE_TAGS);
		preg_match_all($tags_preg, $content, $matches, PREG_OFFSET_CAPTURE);
		
		if(count($matches[1]) % 2 == 1)
		{
			$cut_tag = end($matches[1]);
			$cut_tag_position = $cut_tag[1] - 1;
			$content = substr($content, 0, $cut_tag_position);
		}
		$content = trim($content);
		
		$this->content = $content;
	}

	private function close_tags($etc)
	{
		$content = $this->content;
		$tags_preg = $this->get_tags_preg(self::$INCLUDE_TAGS);
		preg_match_all($tags_preg, $content, $matches);
		$open_tags = array();
		
		foreach($matches[1] as $tag)
		{
			if(in_array($tag, $open_tags))
			{
				$key = array_search($tag, $open_tags);
				unset($open_tags[$key]);
			}
			else
				$open_tags[] = $tag;
		}
		
		$open_tags = array_reverse($open_tags);
		if(count($open_tags) > 0)
		{
			foreach($open_tags as $key => $open_tag)
			{
				if($key == count($open_tags) - 1)
					$content .= $etc;
				$content .= "</{$open_tag}>";
			}
		}
		else
			$content .= $etc;
		
		$this->content = $content;
	}

	private function get_tags_preg($tag_array)
	{
		return '@</?(' . implode('|', $tag_array) . ')@';
	}

}
