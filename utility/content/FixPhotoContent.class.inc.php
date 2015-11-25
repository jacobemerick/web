<?

Loader::load('utility', 'Content');

final class FixPhotoContent extends Content
{

	private static $PHOTO_PLACEHOLDER_MATCH = '@{{photo="(.*)"}}@';
	private static $ERROR_CONTENT = '<div class="photo-holder"><p class="photo-caption">Image (%s) could not be found!</p></div>';
	private static $PHOTO_CONTENT = '<div class="photo-holder"><img src="%sphoto/%s/%s-size-%s.jpg" height="%d" width="%d" alt="%s" /><p class="photo-caption">%s</p></div>';

	protected function execute($is_absolute = false, $size = 'medium')
	{
		preg_match_all(self::$PHOTO_PLACEHOLDER_MATCH, $this->content, $matches);
		foreach($matches[1] as $key => $match)
		{
			$photo_content = $this->get_photo_content($match, $size, $is_absolute);
			$this->content = str_replace($matches[0][$key], $photo_content, $this->content);
		}
		return;
	}

	private function get_file_path($category, $photo, $size, $extension)
	{
		$path = "{$category}/{$photo}-size-{$size}.{$extension}";
		return Loader::getImagePath('photo', $path);
	}

	private function get_photo_content($string, $size, $is_absolute)
	{
		list($category, $file_name) = explode('/', $string);
		list($photo, $extension) = explode('.', $file_name);
		
		$file_path = $this->get_file_path($category, $photo, $size, $extension);
		
		$file_size = getimagesize($file_path);
		
		Loader::load('collector', 'image/PhotoCollector');
		$photo_result = PhotoCollector::fetchRow($category, $photo);
		if($photo_result == false)
			return '';
		
		$height = $file_size[1];
		$width = $file_size[0];
		$description = $photo_result->description;
        
        if ($description == '') {
            Debugger::logMessage("No description for {$category}/{$photo}");
        }
		
		$domain = '/';
		if($is_absolute)
			$domain = Loader::getRootUrl('blog');
		
		return sprintf(self::$PHOTO_CONTENT, $domain, $category, $photo, $size, $height, $width, $description, $description);
	}

}
