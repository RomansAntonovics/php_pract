<?php

namespace App\Controllers;

use App\System\Request;

class ArticlesController extends BaseController
{
    /**
     * @param Request $request
     * @return \App\System\Response
     */
    public function index_action(Request $request)
    {
        return $this->response->html($this->view->render('articles_list'));
    }

    /**
     * @param Request $request
     * @return \App\System\Response
     */
    public function create_action(Request $request)
    {
        return $this->response->html($this->view->render('article'));
    }

    /**
     * @param Request $request
     * @param $slug
     * @return \App\System\Response
     */
    public function show_action(Request $request, $slug)
    {
        return $this->response->html($this->view->render('article'));
    }

    /**
     * @param Request $request
     * @param $slug
     * @return \App\System\Response
     */
    public function edit_action(Request $request, $slug)
    {
        return $this->response->html($this->view->render('article_edit', 'layout', ['slug' => $slug]));
    }

    /**
     * @param Request $request
     * @param $slug
     * @return \App\System\Response
     */
    public function delete_action(Request $request, $slug)
    {
        return $this->response->html($this->view->render('article_list'));
    }
}