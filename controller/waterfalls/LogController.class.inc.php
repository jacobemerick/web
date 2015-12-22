<?

Loader::load('collector', array(
    'image/AlbumCollector',
    'waterfall/LogCollector'));
Loader::load('controller', 'waterfalls/DefaultPageController');

final class LogController extends DefaultPageController
{

    private static $AUTHOR = 'Jacob Emerick';
    private static $AUTHOR_URL = 'http://home.jacobemerick.com/';
    private static $JOURNAL_DIRECTORY = 'journal';

    private static $FULL_IMAGE_LINK = '/photo/%s/%s-size-standard.jpg';
    private static $THUMB_IMAGE_NODE = '<img src="/photo/%s/%s-size-thumb.jpg" alt="%s" height="%s" width="%s" />';
    private static $MEDIUM_IMAGE_NODE = '<img src="/photo/%s/%s-size-small.jpg" alt="%s" height="375" width="500" />';

    private $log;

    public function __construct()
    {
        parent::__construct();
        
        $log_path = URLDecode::getPiece(2);
        
        $this->log = LogCollector::getByAlias($log_path);
        if(!$this->log)
            $this->eject();

        $this->parent_navigation_item = 'journal';
        
        $this->handle_comment_submit(
            self::$WATERFALL_SITE_ID,
            $this->log->alias,
            Loader::getRootUrl('waterfalls') . self::$JOURNAL_DIRECTORY . '/' . $this->log->alias . '/',
            $this->log->title);
        
        $this->add_waterfall_js();
    }

    protected function set_head_data()
    {
        parent::set_head_data();
        
        $this->set_title("{$this->log->title} | " . self::$WEBSITE_TITLE);
        $this->set_description($this->log->introduction);
        
        $keyword_array = array();
        $tag_result = LogCollector::getTagListForLog($this->log->id);
        foreach($tag_result as $tag)
        {
            $keyword_array[] = $tag->name;
        }
        
        $this->set_keywords($keyword_array);
    }

    protected function set_body_data($page_type = 'normal')
    {
        parent::set_body_data($page_type);
        
        $this->set_body('view', 'Log');

        $body_data = $this->get_formatted_log();
        $body_data['comment_array'] = $this->get_comment_array(self::$WATERFALL_SITE_ID, $this->log->alias);
        $body_data['sidebar'] = $this->get_sidebar();
        $body_data['series'] = $this->get_series();
        $body_data['album'] = $this->get_album();
        
        $this->set_body('data', $body_data);
    }

    private function get_formatted_log()
    {
        $formatted_log = array();
        
        $formatted_log['introduction'] = $this->get_log_introduction($this->log);
        $formatted_log['title'] = $this->log->title;
        $formatted_log['url'] = Loader::getRootURL('waterfalls') . self::$JOURNAL_DIRECTORY . '/' . $this->log->alias . '/';

        $formatted_log['body'] = $this->get_formatted_log_body();
        
        return $formatted_log;
    }

    private function get_log_introduction($log)
    {
        if ($log->image_description == '') {
            Debugger::logMessage("No description for {$log->image_category}/{$log->image_name}");
        }
        
        return array(
            'title' => $log->title,
            'url' => Loader::getRootURL('waterfalls') . self::$JOURNAL_DIRECTORY . '/' . $log->alias . '/',
            'date' => $this->get_parsed_date($log->date),
            'publish_date' => $this->get_parsed_date($log->publish_date),
            'introduction' => $log->introduction,
            'image' => sprintf(
                self::$MEDIUM_IMAGE_NODE,
                $log->image_category,
                $log->image_name,
                $log->image_description),
            'author' => self::$AUTHOR,
            'author_url' => self::$AUTHOR_URL,
        );
    }

    // @todo - link things up
    private function get_formatted_log_body()
    {
        $body = $this->log->body;
        
        $body = Content::instance('FixPhoto', $body)->activate(false, 'standard');
        $body = Content::instance('FixInternalLink', $body)->activate();
        
        return $body;
    }

    private function get_series()
    {
        $series = array(
            'previous' => array(),
            'next' => array());
        
        $previous_log = LogCollector::getPreviousLog($this->log->id);
        if($previous_log != false)
        {
            $series['previous'] = (object) array(
                'path' => '/' . self::$JOURNAL_DIRECTORY . '/' . $previous_log->alias . '/',
                'title' => $previous_log->title,
                'date' => $previous_log->date);
        }
        
        $next_log = LogCollector::getNextLog($this->log->id);
        if($next_log != false)
        {
            $series['next'] = (object) array(
                'path' => '/' . self::$JOURNAL_DIRECTORY . '/' . $next_log->alias . '/',
                'title' => $next_log->title,
                'date' => $next_log->date);
        }
        
        return $series;
    }

    private function get_sidebar()
    {
        $sidebar = array();
        
        $sidebar['companion_list'] = array();
        $companions = LogCollector::getCompanionListForLog($this->log->id);
        foreach($companions as $companion)
        {
            $sidebar['companion_list'][] = (object) array(
                'title' => $companion->name,
                'path' => "/companion/{$companion->alias}/");
        }
        
        $sidebar['tag_list'] = array();
        $tags = LogCollector::getTagListForLog($this->log->id);
        foreach($tags as $tag)
        {
            $sidebar['tag_list'][] = (object) array(
                'title' => $tag->name,
                'path' => "/journal/tag/{$tag->alias}/");
        }
        
        $sidebar['waterfall_list'] = array();
        $waterfalls = LogCollector::getWaterfallListForLog($this->log->id);
        foreach($waterfalls as $waterfall)
        {
            $sidebar['waterfall_list'][] = (object) array(
                'title' => $waterfall->name,
                'path' => "/{$waterfall->watercourse_alias}/{$waterfall->alias}/");
        }
        
        return $sidebar;
    }

    private function get_album()
    {
        $album = array();
        
        if($this->log->album == 0)
            return $album;
        
        $photo_list = AlbumCollector::getPhotoListForAlbum($this->log->album);
        foreach($photo_list as $photo)
        {
            $photo_array = array();
            $photo_array['full_link'] = sprintf(self::$FULL_IMAGE_LINK, $photo->category, $photo->name);
            $photo_array['description'] = $photo->description;
            
            if($photo->height < $photo->width)
                list($height, $width) = array(75, 100);
            else
                list($height, $width) = array(100, 75);
            
            if ($photo->description == '') {
                Debugger::logMessage("No description for {$photo->category}/{$photo->name}");
            }
            
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

}