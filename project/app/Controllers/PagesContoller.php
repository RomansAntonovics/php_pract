<?php

namespace App\Controllers;

use App\System\Request;

class PagesContoller extends BaseController
{
    /**
     * @param Request $request
     * @return \App\System\Response
     */
    public function home_action(Request $request)
    {
        return $this->response->html($this->view->render('home'));
    }

    /**
     * @param Request $request
     * @return \App\System\Response
     */
    public function about_action(Request $request)
    {
        return $this->response->html($this->view->render('about'));
    }
}