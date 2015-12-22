<?

Loader::load('controller', 'site/DefaultPageController');

final class ChangelogController extends DefaultPageController
{

	protected function set_head_data()
	{
		$this->set_title("Changelog for Jacob Emerick's Sites");
		$this->set_description("Listing of the last changes done on the framework behind Jacob Emerick's websites. Yeah, he's down with that version control.");
		$this->set_keywords(array('changelog', 'version control', 'code', 'comments', 'Jacob Emerick'));
		
		parent::set_head_data();
	}

	protected function set_body_data()
	{
		parent::set_body_data();
		
		$this->set_body('top_data', array('title' => 'Change Log'));
		
		$this->set_body('body_data', $this->get_changelog());
		$this->set_body('body_view', 'Changelog');
	}

	private function get_changelog()
	{
		Loader::load('collector', 'data/ChangelogCollector');
		$changelog_result = ChangelogCollector::getLast20Changes();
		
		foreach($changelog_result as $change)
		{
			$changelog[] = (object) array(
				'date' => (object) array(
					'stamp' => date('c', strtotime($change->date)),
					'short' => date('M j', strtotime($change->date)),
					'friendly' => date('F j, Y g:i A', strtotime($change->date))),
				'message' => $change->message);
		}
		
		return array('changelog' => $changelog);
	}

}
