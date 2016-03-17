<?php

Loader::load('controller', 'portfolio/DefaultPageController');

class ProjectsController extends DefaultPageController
{

    protected function set_head_data()
    {
        $this->set_title("Projects Page | Jacob Emerick's Portfolio");
        $this->set_description("Collection of key open-source projects that Jacob has developed and maintained over the years.");
        $this->set_keywords([
            'projects',
            'open source',
            'example work',
            'portfolio',
            'Jacob Emerick',
            'software development',
        ]);
    }

    protected function set_body_data()
    {
        $this->set_body('body_view', 'Projects');

        parent::set_body_data();
    }
}
