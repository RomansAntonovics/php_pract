<?php

namespace App\System;

class Application extends Singleton
{
    /** @var Config */
    public $cfg;

    /** @var Db */
    public $db;

    /** @var Request */
    public $request;

    /** @var User */
    public $user;

    /** @var Response */
    public $response;

    protected function __construct()
    {
        global $config;

        parent::__construct();
        $this->cfg = new Config($config);
        $this->db = new Db($this->cfg->get('db'));
        $this->request = new Request();
        $this->response = new Response();
        $this->user = User::getInstance(); //на синглотне создан юзер

        require_once ROOT_DIR . '/routes/web.php';
    }

    public function handle()
    {
        $route = Route::matchRoute();

        if($route['success']) {

            $function = $route['action'];
            $controller = !empty($function[0]) ? $function[0] : null;
            $action = !empty($function[1]) ? $function[1] : null;
            $args = !empty($route['args']) ? $route['args'] : null;
            $existsClass = class_exists($controller);
            $existsAction = method_exists($controller, $action);

            $argValues = $args ? array_values($args) : [];

            if($existsAction) {

                $obj = new $controller();
                $result = $obj->{$action}($this->request, ...$argValues); //теперь всегда будет содержать объект клааса респонс

                return $result;
            }
        }

        return $this->response->response404();
    }
}
