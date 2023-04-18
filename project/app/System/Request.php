<?php

namespace App\System;

class Request
{
    public $url;
    public $ip;
    public $host;
    public $port;
    public $protocol;
    public $path;
    public $get;
    public $post;
    public $contentType;
    public $isXHR = false;
    public $headers;
    public $body;
    public $method;

    public function __construct()
    {
        $this->headers = getallheaders();
        $this->body = file_get_contents('php://input');
        $this->path = $_SERVER['REQUEST_URI'];
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->get = $_GET;
        $this->post = $_POST;

        if(
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], 'xmlhttprequest') == 0
        ){
            $this->isXHR = true;
        }
    }
}