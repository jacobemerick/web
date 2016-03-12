<?php

Loader::load('controller', 'portfolio/DefaultPageController');

class ResumeController extends DefaultPageController
{

    protected function set_data()
    {
        $this->set_title("Resume | Jacob Emerick's Portfolio");
        $this->set_description("Resume for Jacob Emerick, a software engineer extraordinaire");
        $this->set_keywords([
            'resume',
            'programming resume',
            'Jacob Emerick',
            'software engineer',
            'portfolio',
            'shutterstock',
        ]);

        $this->set_body('body_view', 'Resume');
        $this->set_body('left_side_data', [
            'title' => "Resume | Jacob Emerick's Portfolio",
            'menu' => $this->get_menu(),
            'home_link' => Loader::getRootURL(),
        ]);
        $this->set_body('body_data', []);

        $this->set_body_view('Page');
    }
}
