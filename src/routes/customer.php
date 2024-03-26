<?php

// $router->get('/customer', 'App\Controllers\CustomerController@index');
$router->get('/customer/profile', 'App\Controllers\CustomerController@edit');
$router->post('/customer/profile', 'App\Controllers\CustomerController@update');
$router->get('/customer/logout', 'App\Controllers\CustomerController@destroy');
$router->get('/customer/changePasswd', 'App\Controllers\PasswordController@edit');
$router->post('/customer/changePasswd', 'App\Controllers\PasswordController@update');


