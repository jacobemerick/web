<?php

Loader::load('controller', 'portfolio/DefaultPageController');

class ResumeController extends DefaultPageController
{

    protected $resume = 'resume-20160318.json';

    protected function set_head_data()
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
    }

    protected function set_body_data()
    {
        $this->set_body('body_view', 'Resume');

        $resumePath = Loader::getRootURL('portfolio') . "/jsonresume/{$this->resume}";
        $resume = file_get_contents($resumePath);
        $resume = json_decode($resume, true);
        $this->set_body('body_data', $resume);

        parent::set_body_data();
    }
}
