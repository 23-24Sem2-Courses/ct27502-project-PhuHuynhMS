<?php

$router->get('/login', 'App\Controllers\CustomerLoginController@create');
$router->post('/customer/login', 'App\Controllers\CustomerLoginController@index');
