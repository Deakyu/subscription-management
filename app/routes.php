<?php 

    require_once 'Router/Router.php';

    $router = new Router();

    // Register Routes here!
    $router->get('/about', 'PageController@about');


    // User Routes
    $router->get('/user/:id', 'UserController@show');
    $router->get('/user/login', 'UserController@login');
    $router->post('/user/login', 'UserController@signin');
    $router->get('/user/register', 'UserController@register');
    $router->post('/user/register', 'UserController@signup');

    // Subscriptions Routes
    $router->get('/subscriptions', 'SubscriptionController@index');

    // Cards Routes
    $router->get('/cards', 'CardController@index');
    $router->post('/card/save', 'CardController@save');

    // TODO: Fix it to post
    $router->get('/user/logout', 'UserController@logout');
    
    // Callback example
    // $router->get('/abc/:id', function($id) {
    //     view('pages/about', ['title'=>$id]);
    // });