<?php

require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/autoloader.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../functions/functions.php';

use App\System\Application;

session_start();

return Application::getInstance();
