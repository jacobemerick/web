<?

Loader::load('controller', 'waterfalls/DefaultPageController');

abstract class DefaultListController extends DefaultPageController
{

	private static $IMAGE_ELEMENT_PATTERN = '<img src="/photo/%s/%s-size-%s.jpg" alt="%s" height="%s" width="%s" />';

	protected $page;
	protected $page_count;
	protected $offset;

	public function __construct()
	{
		parent::__construct();
		
		$this->page = $this->get_page_number();
		$this->page_count = ceil($this->get_item_count() / $this->get_item_count_per_page());
		$this->offset = ($this->page - 1) * $this->get_item_count_per_page();
		
		$items = $this->get_items();
		if(count($items) < 1)
			$this->eject();
	}

	final protected function get_page_number()
	{
		$page = $this->get_page_number_piece();
		if(isset($page) && is_numeric($page))
			return $page;
		return 1;
	}

	abstract protected function get_page_number_piece();

	abstract protected function get_item_count_per_page();
	abstract protected function format_item($item);
	abstract protected function get_sidebar();
	abstract protected function get_list_view();

	final private function get_introduction()
	{
		if($this->page == 1)
			return $this->get_initial_introduction();
		
		return $this->get_subsequent_introduction();
	}

	abstract protected function get_initial_introduction();
	abstract protected function get_subsequent_introduction();

	private $items;
	protected function get_items()
	{
		if(!isset($this->items))
		{
			$total = $this->get_item_count_per_page();
			$offset = ($this->page - 1) * $this->get_item_count_per_page();
			
			$this->items = $this->get_item_result($total, $offset);
		}
		return $this->items;
	}

	abstract protected function get_item_result($total, $offset);

	private $item_count;
	final private function get_item_count()
	{
		if(!isset($this->item_count))
			$this->item_count = $this->get_item_count_result();
		return $this->item_count;
	}

	abstract protected function get_item_count_result();

	final protected function set_head_data()
	{
		parent::set_head_data();
		
		$this->set_head('next_link', $this->get_list_next_link());
		$this->set_head('previous_link', $this->get_list_prev_link());
		
		if($this->page == 1)
			$meta_array = $this->get_initial_meta();
		else
			$meta_array = $this->get_subsequent_meta();
		
		$this->set_title($meta_array['title']);
		$this->set_description($meta_array['description']);
		$this->set_keywords($meta_array['keywords']);
	}

	abstract protected function get_initial_meta();
	abstract protected function get_subsequent_meta();

    final protected function set_body_data($page_type = 'normal')
    {
        parent::set_body_data($page_type);
		
		$this->set_body('view', $this->get_list_view());
		$this->set_body('data', $this->get_list_body_data());
	}

	final private function get_list_body_data()
	{
		$body_data_array = array();
		
        $body_data_array['introduction'] = $this->get_introduction();
		$body_data_array['items'] = array_map(array($this, 'format_item'), $this->get_items());
		$body_data_array['navigation'] = array(
				'description' => $this->get_list_description(),
				'list' => $this->get_list_link_array());
		$body_data_array['sidebar'] = $this->get_sidebar();
		
		return $body_data_array;
	}

	final private function get_list_prev_link()
	{
		if($this->page == 1)
			return;
		if($this->page == 2)
			return $this->get_list_link_root();
		return $this->get_list_link_root() . ($this->page - 1) . '/';
	}

	final private function get_list_next_link()
	{
		if(($this->page * $this->get_item_count_per_page()) >= $this->get_item_count())
			return;
		return $this->get_list_link_root() . ($this->page + 1) . '/';
	}

	abstract protected function get_list_link_root();

	final private function get_list_link_array()
	{
		$link_array = array();
		
		if($this->get_item_count_per_page() >= $this->get_item_count())
			return $link_array;
		
		$link = new stdclass();
		$link->anchor = '&laquo; previous';
		if($this->get_list_prev_link() !== null)
			$link->uri = $this->get_list_prev_link();
		else
			$link->class = 'inactive';
		$link_array[] = $link;
		
		for($i = 1; $i <= ceil($this->get_item_count() / $this->get_item_count_per_page()); $i++)
		{
			$link = new stdclass();
			$link->anchor = $i;
			
			if($i == $this->page)
				$link->class = 'current';
			else
			{
				if($i == 1)
					$link->uri = $this->get_list_link_root();
				else
					$link->uri = $this->get_list_link_root() . $i . '/';
			}
			
			$link_array[] = $link;
		}
		
		$link = new stdclass();
		$link->anchor = 'next &raquo;';
		if($this->get_list_next_link() !== null)
			$link->uri = $this->get_list_next_link();
		else
			$link->class = 'inactive';
		$link_array[] = $link;
		
		return $link_array;
	}

	final private function get_list_description()
	{
		$start = ($this->page - 1) * $this->get_item_count_per_page() + 1;
		$end = min($this->page * $this->get_item_count_per_page(), $this->get_item_count());
		$total = $this->get_item_count();
		
		return sprintf($this->get_list_description_pattern(), $start, $end, $total);
	}

	abstract protected function get_list_description_pattern();

	final protected function get_image_element($category, $path, $description, $size = 'small')
	{
		switch($size)
		{
			case 'medium' :
				$height = 375;
				$width = 500;
			break;
			case 'small' :
				$height = 180;
				$width = 240;
			break;
		}
		
		return sprintf(self::$IMAGE_ELEMENT_PATTERN, $category, $path, $size, $description, $height, $width);
	}

}