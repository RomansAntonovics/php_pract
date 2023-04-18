<?php

namespace App\System;

class Response
{
    private $types = [
        'json' => 'json',
        'html' => 'html',
        'redirect' => 'redirect',
        '401' => '401',
        '403' => '403',
        '404' => '404',
    ];

    public $responseType = null;
    public $redirectTo = null;
    public $jsonRaw = ''; //отладочное поле
    public $headers = [];//пустой массив
    public $content = '';//пустая строка

    public function html(string $content)
    {
        $this->content = $content;
        $this->responseType = $this->types['html'];
        return $this;
    }

    public function json(array $array)
    {
        $this->jsonRaw = $array;
        $this->content = json_encode($array);
        $this->responseType = $this->types['json'];
        return $this;
    }

    public function redirect($location) //куда перенаправлять
    {
        $this->redirectTo = $location;
        $this->responseType = $this->types['redirect'];
        return $this;
    }

    public function response401()
    {
        $this->responseType = $this->types['401'];
        return $this;
    }

    public function response403()
    {
        $this->responseType = $this->types['403'];
        return $this;
    }

    public function response404()
    {
        $this->responseType = $this->types['404'];
        return $this;
    }

    public function setHeader(string $header) //служебная функция. перед отдачей вставляет заголовки и пока НЕ отправляет
    {
        $this->headers[] = $header; //вставляет в массив и НЕ отправляет
    }

    public function send() //отправляет респонс
    {
        switch ($this->responseType) {
            case 'json' :
                $this->setHeader('Content-Type: application/json');
                break;
            case 'html' :
                $this->setHeader('Content-Type: text/html; charset=UTF-8');
                break;
            case 'redirect' :
                $this->setHeader('Location: ' . $this->redirectTo);
                break;
            case '401' :
                $this->setHeader("HTTP/1.0 401 Unauthorized");
                $this->content = '<h1>401 Unauthorized</h1><br><br><a href="/">Home</a>';
                break;
            case '403' :
                $this->setHeader("HTTP/1.0 403 Forbidden");
                $this->content = '<h1>403 Forbidden</h1><br><br><a href="/">Home</a>';
                break;
            case '404' :
                $this->setHeader("HTTP/1.0 404 Not Found");
                $this->content = '<h1>404 Not found</h1><br><br><a href="/">Home</a>';
                break;
            default :
                throw new \Exception('Unknown response type!');
        }
        //ниженаписанное передаётся в браузер
        foreach ($this->headers as $header) {
            header($header);
        }

        if(!empty($this->content)) {
            echo $this->content;
        }
    }
}