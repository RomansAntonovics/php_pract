<?php

use App\System\Route;
use App\Controllers\PagesController;
use App\Controllers\ArticlesController;
use App\Controllers\UserController;

Route::add('/', [PagesController::class, 'home_action'], 'homepage', 'get', []);
Route::add('/about', [PagesController::class, 'about_action'], 'about_page', 'get', ['slug']);

Route::add('/article_edit/edit/([A-Za-z0-9_-]*)', [ArticlesController::class, 'edit_action'], 'article_edit', 'get', ['slug']);
Route::add('/article/([A-Za-z0-9_-]*)', [ArticlesController::class, 'show_action'], 'article_show', 'get', ['slug']);
Route::add('/articles', [ArticlesController::class, 'index_action'], 'articles_list', 'get', []);
//Route::add('/article_edit'), [ArticlesController::class, 'edit_action'], name 'article_edit', 'get', []);


Route::add('/login', [UserController::class, 'login_action'], 'login', 'post', []);
Route::add('/logout', [UserController::class, 'logout_action'], 'logout', 'get', []);
