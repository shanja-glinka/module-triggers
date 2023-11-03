<?php

namespace triggers\services;

use triggers\Factory;
use triggers\images\ServiceController;

class ViewServiceController extends ServiceController
{
    public function index()
    {
        return include(Factory::$config::FRONTEND_VIEW_DIR . 'index.html');
    }
}
