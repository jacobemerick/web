<?

Loader::load('utility', 'Content');

class URLSafeContent extends Content
{

	protected function execute()
	{
		$this->content = strtolower(str_replace(' ', '-', $this->content));
	}

}