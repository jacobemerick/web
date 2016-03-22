<?php

Loader::load('controller', 'portfolio/DefaultPageController');

class AboutController extends DefaultPageController
{

    protected function set_head_data()
    {
        $this->set_title("Jacob Emerick's Portfolio");
        $this->set_description("Jacob Emerick's Portfolio - collection of programming projects and resume");
        $this->set_keywords([
            'portfolio',
            'Jacob Emerick',
            'web development',
            'web programming',
            'software development',
            'agile',
            'freelance',
        ]);
    }

    protected function set_body_data()
    {
        $this->set_body('body_view', 'About');
        $this->set_body('body_data', []);

        parent::set_body_data();
    }
}
