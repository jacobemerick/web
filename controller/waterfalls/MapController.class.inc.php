<?

Loader::load('controller', 'waterfalls/DefaultPageController');
Loader::load('collector', 'waterfall/WaterfallCollector');

final class MapController extends DefaultPageController
{

    private static $TITLE = 'Map of Upper Peninsula Waterfalls';
    private static $DESCRIPTION = '';
    private static $KEYWORD_ARRAY = array();

    private static $API_KEY = 'AIzaSyA3eWALjUTSIa44KsbOUYRpG0oMd3aNo00';

    private static $HIDE_ON_INITIAL_LOAD_LIST = array(
        'Lower Tahquamenon Falls',
        'Rainbow Falls',
        'Sandstone Falls',
        'Upper Tahquamenon Falls',
    );

    public function __construct()
    {
        parent::__construct();

        $this->add_js('https://maps.googleapis.com/maps/api/js?key=' . self::$API_KEY);
        $this->add_waterfall_js();
    }

    protected function set_head_data()
    {
        parent::set_head_data();
        
        $this->set_title(self::$TITLE . ' | ' . self::$WEBSITE_TITLE);
        $this->set_description(self::$DESCRIPTION);
        $this->set_keywords(self::$KEYWORD_ARRAY);
    }

    protected function set_body_data($page_type = 'wide')
    {
        parent::set_body_data($page_type);
        
        $this->set_head('full_page_map', true);
        $this->set_body('waterfall_list', $this->fetch_waterfall_list());
        $this->set_body('view', 'Map');
    }

    private function fetch_waterfall_list()
    {
        $list = WaterfallCollector::getMapList();
        array_walk($list, array($this, 'parse_waterfall'));
        return $list;
    }

    private function parse_waterfall(&$waterfall)
    {
        $waterfall = (object) array(
            'name'  => $waterfall->name,
            'latitude' => $waterfall->latitude,
            'longitude' => $waterfall->longitude,
            'link' => "/{$waterfall->watercourse_alias}/{$waterfall->alias}/",
            'image' => "/photo/{$waterfall->photo_category}/{$waterfall->photo}-size-medium.jpg",
            'image_alt' => $waterfall->photo_description,
            'watercourse' => $waterfall->watercourse,
            'hide_on_initial_load' => (in_array($waterfall->name, self::$HIDE_ON_INITIAL_LOAD_LIST)),
        );
    }

}
