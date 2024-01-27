<?php

namespace triggers\services;

use triggers\Boot;
use triggers\images\ServiceController;

class ViewServiceController extends ServiceController
{
    public function index()
    {
        return include(Boot::$config::FRONTEND_VIEW_DIR . 'index.html');
    }
}
