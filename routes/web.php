<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    $url = env('APP_URL_SHORTLINKS');
    return $url ? redirect($url) : abort(404);
    // return $router->app->version();
});

$router->get('{link}', 'Redirects@redirect');
