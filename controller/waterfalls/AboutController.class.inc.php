<?

Loader::load('controller', 'waterfalls/DefaultPageController');

final class AboutController extends DefaultPageController
{

    private static $TITLE = 'About the Website | Waterfalls of the Keweenaw';
    private static $DESCRIPTION = 'A little bit about the website, the area, and the reason why someone would hunt down a hundred and fifty waterfalls in the Upper Peninsula.';
    private static $KEYWORD_ARRAY = array(
        'about',
        'waterfalls',
        'birthday trip',
        'Jacob Emerick',
    );

    protected function set_head_data()
    {
        parent::set_head_data();
        
        $this->set_title(self::$TITLE);
        $this->set_description(self::$DESCRIPTION);
        $this->set_keywords(self::$KEYWORD_ARRAY);
    }

    protected function set_body_data($page_type = 'normal')
    {
        parent::set_body_data($page_type);
        
        $this->set_body('view', 'About');
    }

}
