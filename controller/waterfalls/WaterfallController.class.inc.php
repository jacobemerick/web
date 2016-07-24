<?

Loader::load('collector', array(
    'image/AlbumCollector',
    'waterfall/WatercourseCollector',
    'waterfall/WaterfallCollector',
    'waterfall/LogCollector'));
Loader::load('controller', 'waterfalls/DefaultPageController');

final class WaterfallController extends DefaultPageController
{

    private static $STANDARD_IMAGE_NODE = '<img src="/photo/%s/%s-size-standard.jpg" alt="%s" height="600" width="800" />';

    private static $FULL_IMAGE_LINK = '/photo/%s/%s-size-standard.jpg';
    private static $THUMB_IMAGE_NODE = '<img src="/photo/%s/%s-size-thumb.jpg" alt="%s" height="%s" width="%s" />';
    private static $MEDIUM_IMAGE_NODE = '<img src="/photo/%s/%s-size-medium.jpg" alt="%s" height="375" width="500" />';

    private $waterfall;

    public function __construct()
    {
        parent::__construct();

        $path_watercourse = URLDecode::getPiece(1);
        $path_fall = URLDecode::getPiece(2);

        $this->waterfall = WaterfallCollector::getByAlias($path_watercourse, $path_fall);
        if (!$this->waterfall) {
              $this->eject();
        }
        
        $this->handle_comment_submit(
            self::$WATERFALL_SITE_ID,
            "{$this->waterfall->watercourse_alias}/{$this->waterfall->alias}",
            Loader::getRootUrl('waterfalls') . "{$this->waterfall->watercourse_alias}/{$this->waterfall->alias}/",
            $this->waterfall->name);
        
        $this->add_waterfall_js();
    }

    protected function set_head_data()
    {
        parent::set_head_data();

        $this->set_title("{$this->waterfall->name} on {$this->waterfall->watercourse} | " . self::$WEBSITE_TITLE);
        $this->set_description($this->waterfall->description);
        $this->set_keywords((array) $this->waterfall->name);
    }

    protected function set_body_data($page_type = 'normal')
    {
        parent::set_body_data($page_type);

        $body_data = array_merge(
            $this->format_waterfall_data($this->waterfall),
            [
                'comment_array' => $this->get_comment_array(
                    'waterfallsofthekeweenaw.com',
                    "{$this->waterfall->watercourse_alias}/{$this->waterfall->alias}"
                ),
            ]
        );

        $this->set_body('data', $body_data);
        $this->set_body('view', 'Fall');
    }

    private function format_waterfall_data($waterfall)
    {
        $waterfall_data = array();
        $waterfall_data['introduction'] = $this->get_waterfall_introduction($waterfall);
        $waterfall_data['name'] = $waterfall->name;
        $waterfall_data['watercourse'] = $waterfall->watercourse;
        $waterfall_data['path'] = "/{$waterfall->watercourse_alias}/{$waterfall->alias}/";
        $waterfall_data['tagline'] = $waterfall->introduction;
        $waterfall_data['main_photo'] = sprintf(self::$STANDARD_IMAGE_NODE, $waterfall->photo_category, $waterfall->photo, $waterfall->photo_description);
        $waterfall_data['album'] = $this->get_album();
        $waterfall_data['body'] = $this->format_waterfall_content($waterfall->body);
        $waterfall_data['directions'] = $this->format_waterfall_content($waterfall->directions);
        $waterfall_data['sidebar'] = $this->get_sidebar($waterfall);

        return $waterfall_data;
    }

    private function get_waterfall_introduction($waterfall)
    {
        return array(
            'path' => "/{$waterfall->watercourse_alias}/{$waterfall->alias}/",
            'name' => $waterfall->name,
            'watercourse' => $waterfall->watercourse,
            'tagline' => $waterfall->introduction,
        );
    }

    private function get_main_watercourse($alias)
    {
        $watercourse = WatercourseCollector::getByAlias($alias);
        if ($watercourse->parent != 0) {
            $watercourse = WatercourseCollector::getById($watercourse->parent);
        }
        
        return (object) array(
            'name' => $watercourse->name,
            'title' => $watercourse->name,
            'alias' => $watercourse->alias,
        );
    }

    private function format_waterfall_content($content)
    {
        $content = Content::instance('FixInternalLink', $content)->activate();
        
        return $content;
    }

    private function get_album()
    {
        $album = array();
        
        if($this->waterfall->album == 0)
            return $album;
        
        $photo_list = AlbumCollector::getPhotoListForAlbum($this->waterfall->album);
        foreach($photo_list as $photo)
        {
            $photo_array = array();
            $photo_array['full_link'] = sprintf(self::$FULL_IMAGE_LINK, $photo->category, $photo->name);
            $photo_array['description'] = $photo->description;
            
            if($photo->height < $photo->width)
                list($height, $width) = array(75, 100);
            else
                list($height, $width) = array(100, 75);
            
            $photo_array['image_node'] = sprintf(
                self::$THUMB_IMAGE_NODE,
                $photo->category,
                $photo->name,
                $photo->description,
                $height,
                $width);
            
            $album[] = (object) $photo_array;
        }
        
        return $album;
    }

	private function get_sidebar($waterfall)
	{
		$sidebar_data = array();
		$sidebar_data['name'] = $waterfall->name;
		$sidebar_data['watercourse'] = $waterfall->watercourse;
        $sidebar_data['main_watercourse'] = $this->get_main_watercourse($waterfall->watercourse_alias);
		$sidebar_data['rating_display'] = ($waterfall->rating / 2) . '/5';
        $sidebar_data['rating'] = $waterfall->rating;
		$sidebar_data['height'] = Content::instance('ImperialUnit', $waterfall->height)->activate('inches');
		$sidebar_data['width'] = Content::instance('ImperialUnit', $waterfall->width)->activate('inches');
		$sidebar_data['drop_height'] = Content::instance('ImperialUnit', $waterfall->drop_height)->activate('inches');
		$sidebar_data['drop_count'] = $waterfall->drop_count;
		
        $sidebar_data['county'] = (object) array (
            'name' => $waterfall->county,
            'alias' => $waterfall->county_alias,
            'title' => $waterfall->county_title,
        );
        
		$sidebar_data['nearest_town'] = $waterfall->nearest_town;
		$sidebar_data['latitude'] = round($waterfall->latitude, 5);
		$sidebar_data['longitude'] = round($waterfall->longitude, 5);
		$sidebar_data['elevation'] = Content::instance('ImperialUnit', $waterfall->elevation)->activate('feet');
        
        $sidebar_data['map'] = $this->get_map_piece($waterfall);
        
        $sidebar_data['journal_list'] = $this->get_journal_list($waterfall->id);
        
        $sidebar_data['nearby_list'] = $this->get_nearby_list($waterfall->id);
		
		return $sidebar_data;
	}

    private function get_journal_list($waterfall)
    {
        $list = array();
        $log_result = LogCollector::getLogListForWaterfall($waterfall);
        foreach ($log_result as $log_row) {
            $list[] = (object) array(
                'date' => date('F j, Y', strtotime($log_row->date)),
                'title' => $log_row->title,
                'url' => "/journal/{$log_row->alias}/",
            );
        }
        
        return $list;
    }

    private function get_map_piece($waterfall)
    {
        $map_holder = array();
        
        $url = 'https://maps.googleapis.com/maps/api/staticmap';
        $url .= "?center={$waterfall->latitude},{$waterfall->longitude}";
        $url .= "&zoom=8";
        $url .= "&maptype=terrain";
        $url .= "&size=230x200";
        $url .= "&markers=color:red|size:small|{$waterfall->latitude},{$waterfall->longitude}";
        $url .= "&sensor=false";
        $url .= "&key=AIzaSyA3eWALjUTSIa44KsbOUYRpG0oMd3aNo00";
        
        $image = "<img src=\"{$url}\" height=\"200\" width=\"230\" alt=\"{$waterfall->name} Location\" />";
        $map_holder['image'] = $image;
        
        $map_holder['uri'] = '/map/';
        $map_holder['title'] = "View {$waterfall->name} on a larger map";
        
        return (object) $map_holder;
    }

    private function get_nearby_list($waterfall)
    {
        $nearby_list = array();
        
        $result = WaterfallCollector::getNearbyList($waterfall);
        foreach ($result as $row) {
            $nearby_list[] = (object) array(
                'url' => "/{$row->watercourse_alias}/{$row->alias}/",
                'anchor' => $row->name,
                'title' => "{$row->name} of {$row->watercourse}",
                'distance' => Content::instance('ImperialUnit', $row->distance)->activate(false),
            );
        }
        
        return $nearby_list;
    }

}
