<?

final class Search
{

	private $query;
	private $result;
	private $weight;

	function __construct()
	{
		return $this;
	}

	public function setQuery($query)
	{
		$this->query = $query;
		return $this;
	}

	public function setResult($array)
	{
		$this->result = $array;
		return $this;
	}

	public function setWeight($weight)
	{
		$this->weight = $weight;
		return $this;
	}

	public static function instance()
	{
		$reflection = new ReflectionClass('Search');
		return $reflection->newInstance();
	}

	public function perform()
	{
		$weighted_array = array();
		foreach($this->result as $row)
		{
			$weight = $this->get_search_weight($row);
			if($weight > 0)
				$weighted_array[$row['id']] = $weight;
		}
		arsort($weighted_array);
		
		$final_array = array();
		foreach($weighted_array as $id => $weight)
		{
			foreach($this->result as $row)
			{
				if($row['id'] == $id)
					$final_array[] = $row;
			}
		}
		return $final_array;
	}

	private function get_search_weight($row)
	{
		$weight = 0;
		foreach($this->weight as $weight_array)
		{
			$text = $row[$weight_array['field']];
			$weight += $weight_array['weight'] * substr_count(strtolower($text), strtolower($this->query));
		}
		return $weight;
	}

}
