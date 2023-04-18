<?php


use App\System\Application;

// load and initialize our application
/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/bootstrap.php';

// handle the request
$response = $app->handle();

// here we can modify response if needed

// send the response to user
$response->send();

// here we can call any termination methods

exit;
