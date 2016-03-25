<?php

Loader::load('controller', '/PageController');

abstract class DefaultPageController extends PageController
{

    public function __construct()
    {
        parent::__construct();

        $this->add_css('reset');
        $this->add_css('portfolio', 3);
    }

    protected function set_body_data()
    {
        $this->set_body('header_data', [
            'menu' => $this->get_menu(),
            'home_link' => Loader::getRootURL(),
        ]);
        $this->set_body('activity_array', $this->get_recent_activity());

        $this->set_body_view('Page');
    }

    protected function get_menu()
    {
        $menu = [
            [
                'name' => 'About',
                'link' => Loader::getRootURL(),
            ],
            [
                'name' => 'Projects',
                'link' => Loader::getRootURL() . 'projects/',
            ],
            [
                'name' => 'Résumé',
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
