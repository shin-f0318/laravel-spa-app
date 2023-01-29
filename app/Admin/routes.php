<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\UserController;
use App\Admin\Controllers\SpaController;
use App\Admin\Controllers\ContactController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    // ユーザデータ
    $router->resource('users', UserController::class);

    // Spaデータ
    $router->resource('spas', SpaController::class);

    // お問合せデータ
    $router->resource('contacts', ContactController::class);
});
