<?php

$router->post('/customer', 'App\Controllers\CustomerController@store');
$router->get('/customer', 'App\Controllers\CustomerController@index');
