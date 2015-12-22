<?php

Loader::load('controller', '/RobotController');

class WaterfallsRobotController extends RobotController
{

    protected function set_data()
    {
        $this->disallow_for_all_robots('/search/');
    }

}
