<?

Loader::load('collector', 'system/UnacceptableWordCollector');
Loader::load('utility', 'Content');

final class AcceptableContent extends Content
{

	protected function execute()
	{
		$is_acceptable = true;
		foreach($this->getUnacceptableWords() as $unacceptableWord)
		{
			if(stristr($unacceptableWord->word, $this->content))
				$is_acceptable = false;
		}
		return $is_acceptable;
	}

	private $unacceptableWords;
	private function getUnacceptableWords()
	{
		if(!$this->unacceptableWords)
			$this->unacceptableWords = UnacceptableWordCollector::getWords();
		return $this->unacceptableWords;
	}

}