<?

Loader::load('utility', 'Content');

final class FixInternalLinkContent extends Content
{

	private static $LINK_PLACEHOLDER_MATCH = '@{{link="([a-z0-9/-]*)"( anchor="([a-zA-Z0-9\s]*)")?}}@';
	private static $ERROR_CONTENT = '<span>%s</span>';
	private static $LINK_CONTENT = '<a href="%s" target="_blank" />%s</a>';

	protected function execute($is_absolute = true)
	{
		preg_match_all(self::$LINK_PLACEHOLDER_MATCH, $this->content, $matches);
		foreach($matches[1] as $key => $match)
		{
			if(isset($matches[3][$key]))
				$link_content = $this->get_link($match, $is_absolute, $matches[3][$key]);
			else
				$link_content = $this->get_link($match, $is_absolute);
			$this->content = str_replace($matches[0][$key], $link_content, $this->content);
		}
		return;
	}

	private function get_link($string, $is_absolute, $anchor = '')
	{
		list($type, $uri) = explode('/', $string, 2);
		
		$link = '';
		
		switch($type)
		{
			case 'blog' :
				Loader::load('collector', 'blog/PostCollector');
				$post = PostCollector::getPostByURI($uri);
				
				if($post === NULL)
					return;
				
				$link .= ($is_absolute) ? Loader::getRootURL('blog') : '/';
				$link .= "{$post->category}/{$post->path}/";
				
				if($anchor == '')
					$anchor = $post->title;
				
				break;
			case 'blog-tag' :
				$link .= ($is_absolute) ? Loader::getRootURL('blog') : '/';
				$link .= "tag/{$uri}/";
				
				if($anchor == '')
				{
					$anchor = $uri;
					$anchor = str_replace('-', ' ', $anchor);
					$anchor = ucwords($anchor);
				}
				
				break;
			case 'journal' :
				Loader::load('collector', 'waterfall/LogCollector');
				$log = LogCollector::getByAlias($uri);
				
				if($log === NULL)
					return;
				
				$link .= ($is_absolute) ? Loader::getRootURL('waterfalls') : '/';
				$link .= "journal/{$log->alias}/";
				
				if($anchor == '')
					$anchor = $log->title;
				
				break;
			case 'falls' :
                $pieces = explode('/', $uri);
                if (count($pieces) == 1) {
                    Loader::load('collector', 'waterfall/WatercourseCollector');
                    list ($watercourse_alias) = $pieces;
                    $watercourse = WatercourseCollector::getByAlias($watercourse_alias);
                    
                    if ($watercourse == null) {
                        return;
                    }
                    
                    $link .= ($is_absolute) ? Loader::getRootURL('waterfalls') : '/';
                    $link .= "{$watercourse->alias}/";
                    
                    if ($anchor == '') {
                        $anchor = $watercourse->name;
                    }
                } else if (count($pieces) == 2) {
                    Loader::load('collector', 'waterfall/WaterfallCollector');
                    list ($watercourse_alias, $waterfall_alias) = $pieces;
                    $waterfall = WaterfallCollector::getByAlias($watercourse_alias, $waterfall_alias);
                    
                    if ($waterfall == null) {
                        return;
                    }
                    
                    $link .= ($is_absolute) ? Loader::getRootURL('waterfalls') : '/';
                    $link .= "{$waterfall->watercourse_alias}/{$waterfall->alias}/";
                    
                    if ($anchor == '') {
                        $anchor = $waterfall->name;
                    }
                }
				break;
			default :
				break;
		}
		
		return sprintf(self::$LINK_CONTENT, $link, $anchor);
	}

}
