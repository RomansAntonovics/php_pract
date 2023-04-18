<?php

use App\System\Route;
use App\Controllers\PagesContoller;
use App\Controllers\ArticlesController;
use App\Controllers\UserController;

Route::add('/', [PagesContoller::class, 'home_action'], 'homepage', 'get', []);
Route::add('/about', [PagesContoller::class, 'about_action'], 'about_page', 'get', ['slug']);

Route::add('/article/edit/([A-Za-z0-9_-]*)', [ArticlesController::class, 'edit_action'], 'article_edit', 'get', ['slug']);
Route::add('/article/([A-Za-z0-9_-]*)', [ArticlesController::class, 'show_action'], 'article_show', 'get', ['slug']);
Route::add('/articles', [ArticlesController::class, 'index_action'], 'articles_list', 'get', []);

Route::add('/login', [UserController::class, 'login_action'], 'login', 'post', []);
Route::add('/logout', [UserController::class, 'logout_action'], 'logout', 'get', []);
