<?

Loader::load('utility', 'Content');

final class FixImageContent extends Content
{

	private static $IMAGE_PLACEHOLDER_MATCH = '@{{img="(.*)"}}@';

	protected function execute($is_absolute = false)
	{
		preg_match_all(self::$IMAGE_PLACEHOLDER_MATCH, $this->content, $matches);
		foreach($matches[1] as $key => $match)
		{
			$image_path = $this->get_file_path($match);
			$this->content = str_replace($matches[0][$key], $image_path, $this->content);
		}
		return;
	}

	private function get_file_path($file_name)
	{
		return Loader::loadNew('utility', 'ImageOld', (array) $file_name)->getExternalLink();
	}

}