<?

Loader::load('controller', 'lifestream/DefaultPageController');

final class PostController extends DefaultPageController
{

	private static $TITLE = "Post %d | %s Activity | Jacob Emerick's Lifestream";
	private static $DESCRIPTION = "Post %d of %s activity on Jacob Emerick's Lifestream.";

	private static $KEYWORD_ARRAY = array(
		'lifestream',
		'activity stream',
		'Jacob Emerick');

	private $post;

	public function __construct()
	{
		parent::__construct();
		
		$id = URLDecode::getPiece(2);
		if(!$id || !is_numeric($id))
			$this->eject();
		
		$post = $this->activityRepository->getActivityById($id);
		if(!$post)
			$this->eject();
		
		if(URLDecode::getPiece(1) != $post['type'])
			$this->eject();
		
		$this->post = $post;
	}

	protected function set_head_data()
	{
		$this->set_title(sprintf(self::$TITLE, $this->post['id'], ucwords($this->post['type'])));
		$this->set_description(sprintf(self::$DESCRIPTION, $this->post['id'], ucwords($this->post['type'])));
		
		$keyword_array = self::$KEYWORD_ARRAY;
		array_unshift($keyword_array, $this->post['type']);
		$this->set_keywords($keyword_array);
		
		parent::set_head_data();
	}

	protected function set_body_data()
	{
		$this->set_body('title', $this->get_title());
		$this->set_body('description', $this->get_description());
		
		$this->set_body('post', $this->expand_post($this->post, 'full'));
		$this->set_body('type', 'single');
		$this->set_body('view', 'Post');
		
		parent::set_body_data();
	}

	private function get_title()
	{
		switch($this->post['type'])
		{
			case 'blog' :
				return 'Jacob blogged';
			break;
			case 'book' :
				return 'Jacob read again';
			break;
			case 'distance' :
				return 'Jacob ran xor hiked';
			break;
      case 'github' :
        return 'Jacob did code';
      break;
			case 'hulu' :
				return 'What Jacob watched';
			break;
			case 'twitter' :
				return 'What Jacob tweeted';
			break;
			case 'youtube' :
				return 'Jacob Liked a Video';
			break;
		}
	}

	private function get_description()
	{
		switch($this->post['type'])
		{
			case 'blog' :
				return 'Another awesome blog post from Jacob. Did I mention it was awesome?';
			break;
			case 'book' :
				return "Yup, Jacob read another book. Don't tell his parents.";
			break;
			case 'distance' :
				return 'Well, it might have been both at the same time if there was a bear.';
			break;
      case 'github' :
        return 'An epic code change by Jacob on the Githubs.';
      break;
			case 'hulu' :
				return 'It was a cold, dark night, so Jacob watched something on Hulu.';
			break;
			case 'twitter' :
				return 'Just another awesome insight/thought/RT/random from Jacob.';
			break;
			case 'youtube' :
				return "This is a video that Jacob liked on Youtube. It's probably awesome. You should check it out.";
			break;
		}
	}

}
