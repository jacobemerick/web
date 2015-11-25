<?

Loader::load('utility', 'Content');

final class ElapsedTimeContent extends Content
{

	protected function execute()
	{
		$previous_time = strtotime($this->content);
		$current_time = time();
		
		if($current_time <= $previous_time)
			$this->content = 'few seconds ago';
		else if(($current_time - $previous_time) < 30)
			$this->content = 'few seconds ago';
		else if(($current_time - $previous_time) < 1.5 * 60)
			$this->content = 'a minute ago';
		else if(($current_time - $previous_time) < 4 * 60)
			$this->content = 'few minutes ago';
		else if(($current_time - $previous_time) < 7 * 60)
			$this->content = 'five minutes ago';
		else if(($current_time - $previous_time) < 12 * 60)
			$this->content = 'ten minutes ago';
		else if(($current_time - $previous_time) < 17 * 60)
			$this->content = 'fifteen minutes ago';
		else if(($current_time - $previous_time) < 22 * 60)
			$this->content = 'twenty minutes ago';
		else if(($current_time - $previous_time) < 37 * 60)
			$this->content = 'half hour ago';
		else if(($current_time - $previous_time) < 52 * 60)
			$this->content = 'forty-five minutes ago';
		else if(($current_time - $previous_time) < 1.5 * 60 * 60)
			$this->content = 'an hour ago';
		else if(($current_time - $previous_time) < 2.5 * 60 * 60)
			$this->content = 'two hours ago';
		else if(($current_time - $previous_time) < 3.5 * 60 * 60)
			$this->content = 'three hours ago';
		else if(($current_time - $previous_time) < 4.5 * 60 * 60)
			$this->content = 'few hours ago';
		else if(($current_time - $previous_time) < 1 * 24 * 60 * 60 && date('j', $current_time) == date('j', $previous_time) && date('a', $previous_time) == 'pm')
			$this->content = 'this afternoon';
		else if(($current_time - $previous_time) < 1 * 24 * 60 * 60 && date('j', $current_time) == date('j', $previous_time) && date('a', $previous_time) == 'am')
			$this->content = 'this morning';
		else if(($current_time - $previous_time) < 2 * 24 * 60 * 60 && date('j', $current_time) == date('j', $previous_time) + 1 && date('a', $previous_time) == 'pm' && date('G', $previous_time) >= 17)
			$this->content = 'yesterday evening';
		else if(($current_time - $previous_time) < 2 * 24 * 60 * 60 && date('j', $current_time) == date('j', $previous_time) + 1 && date('a', $previous_time) == 'pm')
			$this->content = 'yesterday afternoon';
		else if(($current_time - $previous_time) < 2 * 24 * 60 * 60 && date('j', $current_time) == date('j', $previous_time) + 1 && date('a', $previous_time) == 'am')
			$this->content = 'yesterday morning';
		else if(($current_time - $previous_time) < 3 * 24 * 60 * 60 && date('j', $current_time) == date('j', $previous_time) + 2)
			$this->content = 'two days ago';
		else if(($current_time - $previous_time) < 4 * 24 * 60 * 60 && date('j', $current_time) == date('j', $previous_time) + 3)
			$this->content = 'three days ago';
		else if(($current_time - $previous_time) < 1 * 7 * 24 * 60 * 60 && date('W', $current_time) == date('W', $previous_time))
			$this->content = 'earlier this week';
		else if(($current_time - $previous_time) < 2 * 7 * 24 * 60 * 60 && date('W', $current_time) == date('W', $previous_time) + 1 && date('w', $previous_time) >= 3)
			$this->content = 'late last week';
		else if(($current_time - $previous_time) < 2 * 7 * 24 * 60 * 60 && date('W', $current_time) == date('W', $previous_time) + 1)
			$this->content = 'early last week';
		else if(($current_time - $previous_time) < 3 * 7 * 24 * 60 * 60)
			$this->content = 'few weeks ago';
		else if(($current_time - $previous_time) < 1.25* 4 * 7 * 24 * 60 * 60 && date('n', $current_time) == date('n', $previous_time))
			$this->content = 'earlier this month';
		else if(($current_time - $previous_time) < 2 * 4 * 7 * 24 * 60 * 60 && date('n', $current_time) == date('n', $previous_time) + 1)
			$this->content = 'last month';
		else if(($current_time - $previous_time) < 4 * 4 * 7 * 24 * 60 * 60)
			$this->content = 'several months ago';
		else
			$this->content = 'long ago';
	}

}