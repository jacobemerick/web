<?

Loader::load('utility', 'Content');

final class FetchFirstPhotoContent extends Content
{

	private static $PHOTO_PLACEHOLDER_MATCH = '@{{photo="(.*)"}}@';
	private static $IMAGE_NODE = '<img src="%sphoto/%s/%s-size-%s.%s" height="%d" width="%d" alt="%s" />';
	private static $DEFAULT_RETURN = '';

	protected function execute($is_absolute = false, $size = 'thumb')
	{
		if(preg_match(self::$PHOTO_PLACEHOLDER_MATCH, $this->content, $match) === 1)
			$this->content = $this->get_thumb($match[1], $is_absolute, $size);
		else
			$this->content = self::$DEFAULT_RETURN;
		return;
	}

	private function get_file_path($category, $photo, $size, $extension)
	{
		$path = "{$category}/{$photo}-size-{$size}.{$extension}";
		return Loader::getImagePath('photo', $path);
	}

	private function get_thumb($string, $is_absolute, $size)
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
		
		$domain = '/';
		if($is_absolute)
			$domain = Loader::getRootUrl();
		
		return sprintf(self::$IMAGE_NODE, $domain, $category, $photo, $size, $extension, $height, $width, $description);
	}

}
