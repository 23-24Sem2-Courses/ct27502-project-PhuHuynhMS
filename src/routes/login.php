<?php

$router->get('/login', 'App\Controllers\CustomerLoginController@create');
$router->post('/login', 'App\Controllers\CustomerLoginController@store');
