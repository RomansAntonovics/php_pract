<?php

namespace App\System;

class Route {

    private static $routes = Array();

    /**
     * @param $expression
     * @param $function
     * @param $name
     * @param string $method
     * @param array $args
     */
    public static function add($expression, $function, $name, $method = 'get', $args = []){

        $routeArr = [
            'expression' => $expression,
            'method' => $method,
            'name' => $name,
        ];

        if(is_callable($function)) {
            $routeArr['function'] = $function;
        } else {
            $routeArr['controllerAction'] = $function;
        }

        if(!empty($args)) {
            $routeArr['args'] = $args;
        }

        array_push(self::$routes, $routeArr);
    }

    public static function getAll(){
        return self::$routes;
    }

    public static function matchRoute($basepath = '', $case_matters = false, $trailing_slash_matters = false) {

        // The basepath never needs a trailing slash
        // Because the trailing slash will be added using the route expressions
        $basepath = rtrim($basepath, '/');

        // Parse current URL
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);

        $path = '/';

        // If there is a path available
        if (isset($parsed_url['path'])) {
            // If the trailing slash matters
            if ($trailing_slash_matters) {
                $path = $parsed_url['path'];
            } else {
                // If the path is not equal to the base path (including a trailing slash)
                if($basepath.'/'!=$parsed_url['path']) {
                    // Cut the trailing slash away because it does not matters
                    $path = rtrim($parsed_url['path'], '/');
                } else {
                    $path = $parsed_url['path'];
                }
            }
        }

        $path = urldecode($path);

        // Get current request method
        $method = $_SERVER['REQUEST_METHOD'];

        $returnArray = [
            'success' => false,
            'route' => null,
        ];

        $path_match_found = false;
        $route_match_found = false;

        foreach (self::$routes as $route) {

            // If the method matches check the path

            // Add basepath to matching string
            if ($basepath != '' && $basepath != '/') {
                $route['expression'] = '('.$basepath.')'.$route['expression'];
            }

            // Add 'find string start' automatically
            $route['expression'] = '^'.$route['expression'];

            // Add 'find string end' automatically
            $route['expression'] = $route['expression'].'$';

            // Check path match
            if (preg_match('#'.$route['expression'].'#'.($case_matters ? '' : 'i').'u', $path, $matches)) {

                $path_match_found = true;

                // Cast allowed method to array if it's not one already, then run through all methods
                foreach ((array)$route['method'] as $allowedMethod) {

                    // Check method match
                    if (strtolower($method) == strtolower($allowedMethod)) {

                        array_shift($matches); // Always remove first element. This contains the whole string

                        if ($basepath != '' && $basepath != '/') {
                            array_shift($matches); // Remove basepath
                        }

                        $route_match_found = true;

                        $returnArray['success'] = true;
                        $returnArray['name'] = $route['name'];
                        $returnArray['action'] = $route['function'];
                        $returnArray['route'] = $route;

                        if(!empty($route['args'])) {

                            $args = [];

                            for($i = 0; $i < count($route['args']); $i++) {

                                if(!empty($matches[$i])) {
                                    $args[$route['args'][$i]] = $matches[$i];
                                }
                            }

                            if(count($route['args']) != count($args)) {

                                $returnArray['message'] = 'Wrong arguments for this route';
                                break;
                            }

                            $returnArray['args'] = $args;
                        }

                        // Do not check other routes
                        break;
                    }
                }
            }

            // Break the loop if the first found route is a match
            if($route_match_found) {
                break;
            }

        }

        // No matching route was found
        if (!$route_match_found) {

            // But a matching path exists
            if ($path_match_found) {

                $returnArray['message'] = 'MethodNotAllowed';

            } elseif (empty($returnArray['message'])) {

                $returnArray['message'] = 'PathNotFound';
            }

        }

        return $returnArray;
    }
}
