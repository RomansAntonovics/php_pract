<?php

namespace App\System;

class View extends Singleton
{
    private $viewPath = VIEWS_DIR . '/';

    public function render($view, $layout = 'layout', $vars = [])
    {

        // очень упрощенный рендер-метод

        // распаковываем переменные шаблона

        extract($vars);

        // рендерим шаблон и сохраняем рендер в переменную
        ob_start();
        require $this->viewPath .  $view . '.php';
        $content = ob_get_clean();

        // рендерим контент, полученный на прошлом шаге
        // используя лэйоут и возвращаем полученную строку
        ob_start();
        require $this->viewPath .  $layout . '.php';
        return ob_get_clean();
    }
}