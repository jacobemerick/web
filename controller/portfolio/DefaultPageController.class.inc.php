<?

Loader::load('controller', '/PageController');

abstract class DefaultPageController extends PageController
{

    public function __construct()
    {
        parent::__construct();

        $this->add_css('reset');
        $this->add_css('portfolio');
    }

    protected function get_menu()
    {
        $menu = [
            [
                'name' => 'About',
                'link' => Loader::getRootURL(),
            ],
            [
                'name' => 'Resume',
                'link' => Loader::getRootURL() . 'resume/',
            ],
            [
                'name' => 'Contact',
                'link' => Loader::getRootURL() . 'contact/',
            ],
        ];

        if (!URLDecode::getPiece(1)) {
            $active_page = 'About';
        } else {
            $active_page = ucfirst(URLDecode::getPiece(1));
        }

        return array_map(function ($row) use ($active_page) {
            $row = (object) $row;
            $row->active = ($row->name == $active_page);
            return $row;
        }, $menu);
    }
}
