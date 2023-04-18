<?php

namespace App\Services;

use App\System\Application;

abstract class BaseService
{
    /** @var Application  */
    protected $app;

    public function __construct()
    {
        $this->app = app();
    }
}