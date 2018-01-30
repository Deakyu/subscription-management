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
    $router->get('/subscription/:id', 'SubscriptionController@show');
    $router->post('/subscription/save', 'SubscriptionController@save');
    $router->post('/subscription/update', 'SubscriptionController@update');
    $router->post('/subscription/delete', 'SubscriptionController@delete');

    // Cards Routes
    $router->get('/cards', 'CardController@index');
    $router->post('/card/save', 'CardController@save');
    $router->get('/card/:id', 'CardController@show');
    $router->post('/card/update', 'CardController@update');
    $router->post('/card/delete', 'CardController@delete');

    // TODO: Fix it to post
    $router->get('/user/logout', 'UserController@logout');
    
    // Callback example
    // $router->get('/abc/:id', function($id) {
    //     view('pages/about', ['title'=>$id]);
    // });