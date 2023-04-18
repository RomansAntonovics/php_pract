<?php

use App\System\Application;

// create custom getallheaders function if it doesn't exist (FPM, FastCGI ...)

if (!function_exists('getallheaders')) {
    function getallheaders() {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}

// debug function
function pre($arg)
{
    echo '<pre>';
    var_dump($arg);
    echo '</pre>';
}

/**
 * Helper function for easy access to application
 *
 * @return Application
 */
function app()
{
    return Application::getInstance();
}
