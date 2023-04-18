<?php

namespace App\Services;

class UserService extends BaseService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login($login, $password)
    {

        $sql = "SELECT * FROM users WHERE login = :login AND password = :password";

        $user = $this->app->db->selectOne($sql, [
            ':login' => $login,
            ':password' => $password,
        ]);

        if(!empty($user) && !empty($user['login'])) {
            $_SESSION['user'] = $user;
            return true;
        }

        return false;
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }
}