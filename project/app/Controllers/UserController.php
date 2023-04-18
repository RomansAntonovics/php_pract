<?php

namespace App\Controllers;

use App\System\Request;
use App\Services\UserService;

class UserController extends BaseController
{
    /** @var UserService  */
    protected $userService;

    public function __construct()
    {
        parent::__construct();

        $this->userService = new UserService();
    }

    /**
     * @param Request $request
     * @return \App\System\Response
     */
    public function login_action(Request $request)
    {
        $post = $request->post;
        $login = !empty($post['login']) ? $post['login'] : null;
        $password = !empty($post['password']) ? $post['password'] : null;

        $result = false;

        if($login && $password) {
            $result = $this->userService->login($login, $password);
        }

        if($result) {
            return $this->response->redirect('/');
        }

        return $this->response->html($this->view->render('home', 'layout', ['errors' => [
            'login' => 'Wrong login or password'
        ]]));
    }

    /**
     * @param Request $request
     * @return \App\System\Response
     */
    public function logout_action(Request $request)
    {
        $this->userService->logout();
        return $this->response->redirect('/');
    }
}