<?php

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
$router->group(["prefix" => "company"], function () use ($router) {
    $router->post("get", "CompanyController@get");
});

$router->group(["prefix" => ""], function () use ($router) {
    $router->get("", "ViewController@documents");
    $router->get("details", "ViewController@details");
    $router->get("login", "ViewController@login");
});

$router->group(["prefix" => "user"], function () use ($router) {
    $router->post("login", "UserController@login");
    $router->group(["middleware" => "authToken"], function () use ($router) {
        $router->post("current", "UserController@current");
    });
});

$router->group(["prefix" => "document", "middleware" => "authToken"], function () use ($router) {
    $router->post("get", "DocumentController@get");
    $router->group(["prefix" => "detail"], function () use ($router) {
        $router->post("", "DocumentController@detail");
        $router->patch("change-detail-status", "DocumentController@change_detail_status");
        $router->patch("update-qtyapprove", "DocumentController@update_qtyapprove");
    });
    $router->patch("approved", "DocumentController@approved");
});
