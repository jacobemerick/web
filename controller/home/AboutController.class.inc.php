<?

Loader::load('controller', 'home/DefaultPageController');

final class AboutController extends DefaultPageController
{

	private static $TITLE = 'About | Jacob Emerick';
	private static $DESCRIPTION = 'Some basic information about Jacob Emerick and his past, web development, and hiking adventures';

	private static $KEYWORD_ARRAY = array(
		'Jacob Emerick',
		'jacobemerick',
		'jpemeric',
		'about',
		'bio',
		'web developer',
		'hiker');

	protected function set_head_data()
	{
		$this->set_title(self::$TITLE);
		$this->set_description(self::$DESCRIPTION);
		$this->set_keywords(self::$KEYWORD_ARRAY);
		
		parent::set_head_data();
	}

	protected function set_body_data()
	{
		$this->set_body_view('About');
		
		parent::set_body_data();
	}

}