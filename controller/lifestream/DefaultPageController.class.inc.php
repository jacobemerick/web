<?

Loader::load('controller', '/PageController');
Loader::load('utility', 'Content');

abstract class DefaultPageController extends PageController
{

  protected $postRepository;

  public function __construct()
  {
    parent::__construct();

    global $container;
    $this->postRepository = new Jacobemerick\Web\Domain\Stream\Post\MysqlPostRepository($container['db_connection_locator']);
  }

	protected function set_head_data()
	{
		$this->add_css('normalize');
		$this->add_css('lifestream');
	}

	protected function set_body_data()
	{
		$this->set_body_view('Page');
	}

}
