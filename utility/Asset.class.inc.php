<?php

Loader::load('utility', 'URLDecode');

class Asset
{

	private static $GOOGLE_FONT_LINK = 'http://fonts.googleapis.com/css?family=';

	static public function getGoogleFontCSS($fonts)
	{
		$font_link = implode('|', $fonts);
		$font_link = str_replace(' ', '+', $font_link);
		$link = self::$GOOGLE_FONT_LINK . $font_link;
		return $link;
	}

	static public function getCSS($array)
	{
		$simple_pieces = array();
		$complex_pieces = array();
		foreach($array as $piece)
		{
			switch($piece)
			{
				case 'global' :
					$simple_pieces[] = $piece;
				break;
				default :
					$complex_pieces[] = $piece;
				break;
			}
		}
		
		foreach($simple_pieces as $piece)
		{
			$final_files[] = self::process_simple_pieces('styles', $piece);
		}
		$final_files[] = self::process_complex_pieces('styles', $complex_pieces);
		
		return $final_files;
	}

	static public function getJS($array)
	{	
		$simple_pieces = array();
		$complex_pieces = array();
		$external_pieces = array();
		
		foreach($array as $piece)
		{
			switch($piece)
			{
				case 'jquery-1.4.2' :
                case 'jquery-1.10.2.min' :
				case 'jquery-ui-1.8.2' :
				case 'ga' :
					$simple_pieces[] = $piece;
				break;
				case stripos($piece, 'http') === 0 :
					$external_pieces[] = $piece;
				break;
				default :
					$complex_pieces[] = $piece;
				break;
			}
		}
		
		foreach($external_pieces as $piece)
		{
			$final_files[] = $piece;
		}
		foreach($simple_pieces as $piece)
		{
			$final_files[] = self::process_simple_pieces('scripts', $piece);
		}
		$final_files[] = self::process_complex_pieces('scripts', $complex_pieces);
		
		return $final_files;
	}

	private static function process_simple_pieces($type, $file)
	{
		$piece_path = self::get_piece_path($type, $file);
		$final_path = self::get_final_path($type, $file);
		
		if(!$final_path)
		{
			$contents = file_get_contents($piece_path);
			return self::make_final_file($type, $contents, $file);
		}
		
		$file_name = substr($final_path, strpos($final_path, $file), strrpos($final_path, '.') - strpos($final_path, $file));
		
		if(filemtime($final_path) < filemtime($piece_path))
		{
			$contents = file_get_contents($piece_path);
			return self::make_final_file($type, $contents, $file_name, true);
		}
		
		return self::get_final_link($type, $file_name);
	}

	private static function process_complex_pieces($type, $array)
	{
		if(in_array(404, $array))
			$site = '404';
		else if(in_array(503, $array))
			$site = '503';
		else
			$site = strtolower(URLDecode::getSite());
		
		$final_path = self::get_final_path($type, $site);
		
		if(!$final_path)
		{
			$contents = '';
			foreach($array as $file)
			{
				$piece_path = self::get_piece_path($type, $file);
                $contents .= "/*** {$file} ***/\n\n";
				$contents .= file_get_contents($piece_path);
                $contents .= "\n\n\n";
			}
			return self::make_final_file($type, $contents, $site);
		}
		
		$file_name = substr($final_path, strrpos($final_path, $site), strpos($final_path, '.') - strrpos($final_path, $site));
		
		$create_new = false;
		$contents = '';
		foreach($array as $file)
		{
			$piece_path = self::get_piece_path($type, $file);
			$contents .= file_get_contents($piece_path);
			if(filemtime($final_path) < filemtime($piece_path))
				$create_new = true;
		}
		if($create_new)
			return self::make_final_file($type, $contents, $file_name, true);
		
		return self::get_final_link($type, $file_name);
	}

	private static function get_final_path($type, $file)
	{
		$path = Loader::getRoot() . "/{$type}/final/{$file}*";
		
		$files = glob($path); 
		if(count($files) > 0)
			return $files[0];
		return;
	}

	private static function get_piece_path($type, $file)
	{
		$path = Loader::getRoot() . "/{$type}/piece/{$file}*";
		
		$files = glob($path);
		if(count($files) > 0)
			return $files[0];
		return;
	}

	private static function make_final_file($type, $contents, $file_name, $exists = false)
	{
		if($exists)
		{
			$old_file = self::get_final_path($type, $file_name);
			$version = substr($old_file, strpos($old_file, $file_name));
			if(strpos($version, '-v'))
			{
				$version = substr($version, strpos($version, '-v'));
				$version = substr($version, 2, strpos($version, '.') - 2);
				$version++;
				$file_name = substr($file_name, 0, strpos($file_name, '-v'));
			}
			else
				$version = 2;
			$file_name .= "-v{$version}";
		}
		
		$path = Loader::getRoot() . "/{$type}/final/{$file_name}";
		
		switch($type)
		{
			case 'styles' :
				$path .= '.css';
			break;
			case 'scripts' :
				$path .= '.js';
			break;
		}
		
		file_put_contents($path, $contents);
		if($exists)
			unlink($old_file);
		Debugger::logMessage("New {$type} file created - {$file_name}.");
		return self::get_final_link($type, $file_name);
	}

	private static function get_final_link($type, $file_name)
	{
		switch($type)
		{
			case 'styles' :
				$path = "/style/{$file_name}.css";
			break;
			case 'scripts' :
				$path = "/script/{$file_name}.js";
			break;
		}
		return $path;
	}

	public static function getLastModified($type, $file)
	{
		$final_path = self::get_final_path($type, $file);
		return filemtime($final_path);
	}

}

?>