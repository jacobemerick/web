<?

Loader::load('controller', 'lifestream/DefaultPageController');

final class AboutController extends DefaultPageController
{

	private static $TITLE = "About | What's a Lifestream?";
	private static $DESCRIPTION = 'A breakdown of what a lifestream is, why Jacob Emerick made one, and how he made it.';

	private static $KEYWORD_ARRAY = array(
		'about',
		'lifestream',
		'feed',
		'activity stream',
		'Jacob Emerick',
		'jpemeric');

	protected function set_head_data()
	{
		$this->set_title(self::$TITLE);
		$this->set_description(self::$DESCRIPTION);
		$this->set_keywords(self::$KEYWORD_ARRAY);
		
		parent::set_head_data();
	}

	protected function set_body_data()
	{
		$this->set_body('title', "WHAT'S A LIFESTREAM?");
		$this->set_body('type', 'about');
		$this->set_body('view', 'About');
		
		parent::set_body_data();
	}

}