<?php

namespace App\System;

class User extends Singleton
{
    /** @var array  */
    private $user = [];

    /** @var bool  */
    private $isLogged = false;

    public function __construct()
    {
        if(!empty($_SESSION['user'])) {
            $this->user = $_SESSION['user'];
            $this->isLogged = true;
        }
    }

    public function getUser()
    {
        return $this->user;
    }

    public function isLogged()
    {
        return $this->isLogged;
    }
}