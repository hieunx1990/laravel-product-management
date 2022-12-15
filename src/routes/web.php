<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => 'Hieu\\ProductManagement\\Controllers',
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.product',
], function (Router $router) {

    $router->resource('/products', ProductController::class);

});
