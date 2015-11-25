<?

Loader::load('controller', 'blog/DefaultPageController');

final class AboutController extends DefaultPageController
{

	private static $TITLE = 'About the Blog | Jacob Emerick';
	private static $DESCRIPTION = "A little bit about the awesomeness on Jacob Emerick's Blog, diving into the topics covered, technology used, and methodology of writing new posts.";

	private static $KEYWORD_ARRAY = array(
		'about',
		'technologies',
		'background',
		'blog',
		'Jacob Emerick');

	protected function set_head_data()
	{
		$this->set_title(self::$TITLE);
		$this->set_description(self::$DESCRIPTION);
		$this->set_keywords(self::$KEYWORD_ARRAY);
		
		parent::set_head_data();
	}

	protected function set_body_data()
	{
		$this->set_body('view', 'About');
		
		parent::set_body_data();
	}

	protected function get_introduction()
	{
		Loader::load('collector', 'blog/IntroductionCollector');
		$introduction_result = IntroductionCollector::getRow('about');
		
		if($introduction_result !== null)
		{
			$introduction = array();
			$introduction['title'] = $introduction_result->title;
			$introduction['content'] = $introduction_result->content;
			$introduction['image'] = $this->get_introduction_image($introduction_result->image);
			
			return $introduction;
		}
	}

}