<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'domain'     => config('admin.route.domain'),
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('users', 'UserController');
    $router->get('api/users', 'UserController@apiIndex');

    $router->resource('categories', 'CategoryController');
    $router->get('api/categories', 'CategoryController@apiIndex');

    $router->resource('tags', 'TagController');
    $router->get('api/tags', 'TagController@apiIndex');

    $router->resource('articles', 'ArticleController');
});
