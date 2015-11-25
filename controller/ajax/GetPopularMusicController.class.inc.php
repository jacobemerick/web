<?

Loader::load('collector', 'data/MusicCollector');
Loader::load('controller', '/AJAXController');
Loader::load('utility', array(
	'ImageOld',
	'Mail'));

class GetPopularMusicController extends AJAXController
{

	private static $TIME_LIMIT = 4838600; // 8 weeks = cut off for effectiveness
	private static $DAY = 86400; // one day
	private static $WEIGHT_FACTOR = .8; // drop down of influence each listen has per day
	private static $POSITION_ATTEMPTS = 1500;

	private static $X_OFFSET	= -40;
	private static $Y_OFFSET	= -25;

	private static $LARGE_ALBUM_ART		= 400;
	private static $MEDIUM_ALBUM_ART	= 200;
	private static $SMALL_ALBUM_ART		= 100;
	private static $LCD_ALBUM_ART		= 100;

	private static $LARGE_COUNT		= 3;
	private static $MEDIUM_COUNT	= 8;
	private static $DEFAULT_WIDTH	= 800;
	private static $DEFAULT_HEIGHT	= 600;

	private static $INVALID_IMAGE_PATH_CHARACTERS = array(
		'(',
		')',
		':',
		'.',
		',',
		"'",
		'!',
		'/');

	private $window_height;
	private $window_width;

	private $large_count;
	private $medium_count;

	public function __construct()
	{
		parent::__construct();
		
		$this->get_size_counts();
	}

	private function get_size_counts()
	{
		$this->window_height = Request::getPost('height') + 2 * abs(self::$Y_OFFSET);
		$this->window_width = Request::getPost('width') + 2 * abs(self::$X_OFFSET);
		
		if(!$this->window_height || !$this->window_width)
			$this->eject('No window params passed in!');
		
		$default_size = self::$DEFAULT_WIDTH * self::$DEFAULT_HEIGHT;
		$window_size = $this->window_width * $this->window_height;
		$relative_window = $window_size / $default_size;
		
		$this->large_count = floor($relative_window * self::$LARGE_COUNT);
		$this->medium_count = floor($relative_window * self::$MEDIUM_COUNT);
	}

	protected function set_data()
	{
		$popular_music = $this->get_popular_music();
		
		$popular_music = $this->get_weighted($popular_music);
		
		$popular_music = $this->get_display($popular_music);
		
		$popular_music = $this->get_placement($popular_music);
		
		$this->set_response($popular_music, 'popular_music');
		return true;
	}

	private function get_popular_music()
	{
		$start_date = date('Y-m-d', (time() - self::$TIME_LIMIT));
		$end_date = date('Y-m-d');
		$popular_music_result = MusicCollector::getPlayedMusicForRange($start_date, $end_date);
		
		$popular_music = array();
		foreach($popular_music_result as $popular_music_row)
		{
			$popular_music[] = array(
				'album' => $popular_music_row->album,
				'artist' => $popular_music_row->artist,
				'count' => $popular_music_row->count,
				'date' => $popular_music_row->date);
		}
		return $popular_music;
	}

	private function get_weighted($popular_music)
	{
		$array = array();
		foreach($popular_music as $item)
		{
			$delay = $item['date'];
			$delay = time() - strtotime($delay);
			$delay = $delay / self::$DAY;
			$delay = floor($delay);
			
			$weight = $item['count'];
			$weight = $weight * pow(self::$WEIGHT_FACTOR, $delay);
			
			$key = md5($item['album'] . $item['artist']);
			
			if(!array_key_exists($key, $array))
			{
				$array[$key] = array(
					'album' => $item['album'],
					'artist' => $item['artist'],
					'weight' => $weight);
			}
			else
				$array[$key]['weight'] += $weight;
		}
		
		usort($array, create_function('$a, $b', 'return $a["weight"] < $b["weight"];'));
		return $array;
	}

	private function get_display($popular_music)
	{
		$invalid_large_images = array();
		$i = 1;
		foreach($popular_music as $key => $item)
		{
			$artist = $item['artist'];
			$artist = $this->clean_image_path($artist);
			
			$album = $item['album'];
			$album = $this->clean_image_path($album);
			
			$image_path = "{$artist}/{$album}";
			
			$large_image_path = "{$image_path}-slarge.jpg";
			$large_image = new ImageOld("music/{$large_image_path}");
			if($large_image->isValid())
			{
				if($i <= $this->large_count)
					$size = 'large';
				else if($i <= $this->medium_count)
					$size = 'medium';
				else
					$size = 'small';
				
				$popular_music[$key]['display_image'] = "/{$image_path}-cbw-s{$size}.jpg";
				$popular_music[$key]['color_image'] = "/{$image_path}-s{$size}.jpg";
				$popular_music[$key]['large_image'] = "/{$large_image_path}";
				$popular_music[$key]['size'] = $size;
				
				$i++;
			}
			else
			{
				$invalid_large_images[] = $large_image_path;
				unset($popular_music[$key]);
			}
			
			unset($popular_music[$key]['weight']);
			$i++;
		}
		
		if(count($invalid_large_images))
		
		return $popular_music;
	}

	private function clean_image_path($path)
	{
		$path = strtolower($path);
		$path = str_replace(' ', '-', $path);
		$path = str_replace('&', 'and', $path);
		$path = str_replace(self::$INVALID_IMAGE_PATH_CHARACTERS, '', $path);
		return $path;
	}

	private function get_placement($popular_music)
	{
		foreach($popular_music as $key => $item)
		{
			switch($item['size'])
			{
				case 'large' :
					$size = self::$LARGE_ALBUM_ART;
				break;
				case 'medium' :
					$size = self::$MEDIUM_ALBUM_ART;
				break;
				case 'small' :
					$size = self::$SMALL_ALBUM_ART;
				break;
			}
			list($x_position, $y_position) = $this->get_position($size);
			
			if($x_position !== null && $y_position !== null)
			{
				$popular_music[$key]['left'] = $x_position;
				$popular_music[$key]['top'] = $y_position;
				unset($popular_music[$key]['size']);
			}
			else
				unset($popular_music[$key]);
		}
		return $popular_music;
	}

	private function get_position($size)
	{
		$x_range = ceil($this->window_width / self::$LCD_ALBUM_ART);
		$y_range = ceil($this->window_height / self::$LCD_ALBUM_ART);
		
		$scaled_width = $size / self::$LCD_ALBUM_ART;
		$scaled_height = $size / self::$LCD_ALBUM_ART;
		
		$has_position = false;
		$attempt = 1;
		
		while($has_position == false && $attempt <= self::$POSITION_ATTEMPTS)
		{
			$x_position = rand(0, $x_range - $scaled_width);
			$x_position = $x_position * self::$LCD_ALBUM_ART;
			
			$y_position = rand(0, $y_range - $scaled_height);
			$y_position = $y_position * self::$LCD_ALBUM_ART;
			
			$has_position = $this->check_position($x_position, $y_position, $size);
			$attempt++;
		}
		
		if($has_position)
		{
			$x_position += self::$X_OFFSET;
			$y_position += self::$Y_OFFSET;
			return array($x_position, $y_position);
		}
		else
			return array(null, null);
	}

	private $placement_array = array();
	private function check_position ($x_position, $y_position, $album_size)
	{
		if(empty($this->placement_array))
		{
			for(
				$x = 0;
				$x < $this->window_width;
				$x += self::$LCD_ALBUM_ART)
			{
				for(
					$y = 0;
					$y < $this->window_height;
					$y += self::$LCD_ALBUM_ART)
				{
					$this->placement_array["{$x}-{$y}"] = 0;
				}
			}
		}
		
		for(
			$x = $x_position;
			$x < ($x_position + $album_size);
			$x += self::$LCD_ALBUM_ART)
		{
			for(
				$y = $y_position;
				$y < ($y_position + $album_size);
				$y += self::$LCD_ALBUM_ART)
			{
				if($this->placement_array["{$x}-{$y}"] == 1)
					return false;
			}
		}
		
		for(
			$x = $x_position;
			$x < ($x_position + $album_size);
			$x += self::$LCD_ALBUM_ART)
		{
			for(
				$y = $y_position;
				$y < ($y_position + $album_size);
				$y += self::$LCD_ALBUM_ART)
			{
				$this->placement_array["{$x}-{$y}"] = 1;
			}
		}
		
		return true;
	}

}
