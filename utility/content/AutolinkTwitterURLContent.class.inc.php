<?

Loader::load('utility', 'Content');

final class AutolinkTwitterURLContent extends Content
{

	private static $LINK_PATTERN = '@https?://([a-z0-9-+&#%?=~_|!:,\.;]+)[a-z0-9-+&#/%?=~_|!:,\.;]*[a-z0-9+&#/%=~_|]@i';
	private static $DISPLAY_URL_LENGTH = 40;

	protected function execute()
	{
		if(stristr($this->content, 'http') === false)
			return;
		
		$parameters = func_get_args();
		if(count($parameters) > 1 || (count($parameters) == 1 && !is_array($parameters[0])))
		{
			trigger_error('Unexpected parameters passed into AutolinkTwitterURL!');
			return;
		}
		$parameters = array_shift($parameters);
		
		$found_link = preg_match_all(self::$LINK_PATTERN, $this->content, $matches, PREG_SET_ORDER);
		if($found_link === false || $found_link === 0)
			return;
		
		foreach($matches as $match)
		{
			$parameters['href'] = $match[0];
			$display_url = $this->get_display_url($match);
			
			$replacement = $this->get_replacement_link($parameters, $display_url);
			$this->content = str_replace($match[0], $replacement, $this->content);
		}
		
		return;
	}

	private function get_display_url($match)
	{
		$display_url = $this->check_for_redirect($match[0]);
		
		if(strlen($display_url) > (self::$DISPLAY_URL_LENGTH - 2))
		{
			$display_url = substr($display_url, 0, self::$DISPLAY_URL_LENGTH);
			$display_url .= '...';
		}
		
		return $display_url;
	}

	private function get_replacement_link($parameters, $display_url)
	{
		$link = '<a';
		foreach($parameters as $attribute => $value)
		{
			$link .= ' ';
			$link .= $attribute;
			$link .= '=';
			$link .= '"' . $value .'"';
		}
		$link .= '>';
		$link .= $display_url;
		$link .= '</a>';
		
		return $link;
	}

	private function check_for_redirect($url)
	{
		$headers = @get_headers($url);
		if($headers === false)
			$headers = $this->get_headers($url);
		
		if(stristr($headers[0], '301') !== false || stristr($headers[0], '302') !== false)
		{
			foreach($headers as $header)
			{
				if(substr($header, 0, 9) == 'Location:')
					break;
			}
			
			$url = substr($header, 10);
			$url = $this->check_for_redirect($url);
		}
		
		return $url;
	}

	private function get_headers($url)
	{
		$handler = curl_init();
		
		curl_setopt($handler, CURLOPT_URL, $url);
		curl_setopt($handler, CURLOPT_HEADER, 1);
		curl_setopt($handler, CURLOPT_NOBODY, 1);
		curl_setopt($handler, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($handler, CURLOPT_TIMEOUT, 1000);
		
		$headers = curl_exec($handler);
		$headers = explode("\n", $headers);
		
		return $headers;
	}

}