<?php

class ImageOld
{

	private static $VERSION_PREG_MATCH = '/-v(\d+)/';

	const X_LARGE = 'xlarge'; // 1600 X 1200
	const LARGE = 'large'; // 1024 X 768
	const MEDIUM = 'medium'; // 500 X 375
	const SMALL = 'small'; // 240 X 180
	const THUMBNAIL = 'thumbnail'; // 100 X 75

	private $image;
	private $file;
	private $image_meta;

	function __construct($image)
	{
		$this->image = $this->get_image($image);
		$this->file = $this->get_file($this->image);
		//$this->image_meta = $this->get_image_meta($image);
	}

	public function getExternalLink()
	{
		return Loader::getRootURL('images') . $this->file;
	}

	public function getInternalPath()
	{
		return Loader::getRoot() . '/images/' . $this->file;
	}

	public function isValid()
	{
		return file_exists($this->getInternalPath());
	}

	public function isInTable()
	{
		return $this->image_meta !== null;
	}

	public function getExtension()
	{
		$extension = $this->image;
		$extension = strrchr($extension, '.');
		$extension = substr($extension, 1);
		return $extension;
	}

	public function setSize($size)
	{
		if($this->get_version() > 1)
			$position = strrpos($this->file, '-v');
		else
			$position = strrpos($this->file, '.');
		
		$this->file = substr($this->file, 0, $position) . '-s' . $size . substr($this->file, $position);
	}

	public function getDimensions()
	{
		if(!$this->isValid())
			return false;
		$imageinfo = getimagesize($this->getInternalPath());
		return array($imageinfo[0], $imageinfo[1]);
	}

	public function getDescription()
	{
		return $this->image_meta->getImageDescription()->getDescription();
	}

	public function getLastModified()
	{
		return filemtime($this->getInternalPath());
	}

	public function load()
	{
		Loader::load('images', $this->file);
	}

	private function get_image($image)
	{
		if(preg_match(self::$VERSION_PREG_MATCH, $image))
			return preg_replace(self::$VERSION_PREG_MATCH, '', $image);
		else
			return $image;
	}

	private function get_image_meta($image)
	{
		trigger_error('Tried to use old deprecated image logic to get meta - BAD!');
		return;
	}

	private function get_file($image)
	{
		if($this->get_version() > 1)
		{
			$position = strrpos($image, '.');
			return substr($image, 0, $position) . '-v' . $this->get_version() . substr($image, $position);
		}
		else
			return $image;
	}

	private $version;
	private function get_version()
	{
		if(!$this->version)
		{
			$path = Loader::getRoot() .'/images/' . substr($this->image, 0, strrpos($this->image, '.')) . '*';
			$files = glob($path);
			if(count($files) > 0)
			{
				preg_match(self::$VERSION_PREG_MATCH, $files[0], $matches);
				if(count($matches))
					$this->version = $matches[1];
				else
					$this->version = 1;
			}
		}
		return $this->version;
	}

}

?>