<?php

namespace App\Controllers;

use App\System\Application;
use App\System\Response;
use App\System\View;

abstract class BaseController
{
    /** @var View */
    protected $view;

    /** @var Application  */
    protected $app;

    /** @var Response */
    protected $response;

    public function __construct()
    {
        $this->view = View::getInstance();
        $this->app = Application::getInstance();
        $this->response = $this->app->response;
    }
}
