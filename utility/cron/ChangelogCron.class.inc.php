<?

Loader::load('collector', 'data/ChangelogCollector');
Loader::load('utility', 'Content');
Loader::load('utility', 'cron/Cron');

set_time_limit(200);

final class ChangelogCron extends Cron
{

	private static $MAXIMUM_LOOP_COUNT = 1000;
	private static $QUERY = "INSERT INTO `jpemeric_data`.`changeset` (`number`,`date`,`author`,`message`,`files_added`,`files_modified`,`files_moved`,`files_copied`,`files_removed`) VALUES ('%d','%s','%s','%s','%d','%d','%d','%d','%d')";
	private static $XML_PATH = 'http://svn.reynrick.com/t_jakemvc/changeset/';

	public function activate()
	{
		$loop_count = 0;
		for($loop_count = 0; $loop_count < self::$MAXIMUM_LOOP_COUNT; $loop_count++)
		{
			$changeset_to_check = $this->get_changeset_to_check();
			$data = $this->get_changeset_page_data($changeset_to_check);
			
			if(!isset($data))
				break;
			
			$this->save_changeset_data($data);
			if($loop_count > 20)
				exit;
		}
		
		return true;
	}

	private function save_changeset_data($data)
	{
		$number = Database::escape($data['number']);
		$date = Database::escape($data['date']);
		$author = Database::escape($data['author']);
		$message = Database::escape($data['message']);
		$files_added = Database::escape($data['files_added']);
		$files_modified = Database::escape($data['files_modified']);
		$files_moved = Database::escape($data['files_moved']);
		$files_copied = Database::escape($data['files_copied']);
		$files_removed = Database::escape($data['files_removed']);
		
		$query = self::$QUERY;
		$query = sprintf($query, $number, $date, $author, $message, $files_added, $files_modified, $files_moved, $files_copied, $files_removed);
		Database::execute($query);
	}

	private function get_changeset_to_check()
	{
		$changeset = ChangelogCollector::getMostRecentChange();
		
		if($changeset === null)
			return 1;
		
		$number = $changeset->number;
		$number++;
		return $number;
	}

	private function get_changeset_page_data($page = '')
	{
		$changeset_page = $this->get_changeset_page($page);
		
		preg_match('@<h1>(.+)</h1>@', $changeset_page, $match);
		if(stristr($match[1], 'Error: Invalid Changeset Number') !== false)
			return;
		
		preg_match('@<h1>Changeset (\d+)</h1>@', $changeset_page, $match);
		$number = $match[1];
		
		preg_match('@<dd class="time">([\d/]+) ([\d:]+)@', $changeset_page, $match);
		$date = strtotime("{$match[1]} {$match[2]}");
		$date = date('Y-m-d H:i:s', $date);
		
		preg_match('@<dd class="author">(\w+)</dd>@', $changeset_page, $match);
		$author = $match[1];
		
		$start = strpos($changeset_page, '<dd class="message searchable">');
		$start += strlen('<dd class="message searchable">');
		$end = strpos($changeset_page, '</dd>', $start);
		$length = $end - $start;
		
		$message = substr($changeset_page, $start, $length);
		$message = trim($message);
		$message = substr($message, 4, -11);
		$message = preg_replace('@<a class="missing wiki" href="/t_jakemvc/wiki/[a-z0-9]+" rel="nofollow">([a-z0-9]+)\?</a>@i', '$1', $message);
		
		preg_match('@<dt class="add"></dt><dd>(\d+) added</dd>@', $changeset_page, $match);
		$files_added = $match[1];
		
		preg_match('@<dt class="mod"></dt><dd>(\d+) modified</dd>@', $changeset_page, $match);
		$files_modified = $match[1];
		
		preg_match('@<dt class="mv"></dt><dd>(\d+) moved</dd>@', $changeset_page, $match);
		$files_moved = $match[1];
		
		preg_match('@<dt class="cp"></dt><dd>(\d+) copied</dd>@', $changeset_page, $match);
		$files_copied = $match[1];
		
		preg_match('@<dt class="rem"></dt><dd>(\d+) removed</dd>@', $changeset_page, $match);
		$files_removed = $match[1];
		
		return compact(
			'number',
			'date',
			'author',
			'message',
			'files_added',
			'files_modified',
			'files_moved',
			'files_copied',
			'files_removed');
	}

	private function get_changeset_page($page = '')
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, self::$XML_PATH . $page);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_USERPWD, 'USER:PASS');
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		$curl_output = curl_exec($curl);
		curl_close($curl);
		
		return $curl_output;
	}

}
