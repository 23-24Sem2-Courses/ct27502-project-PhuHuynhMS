<?php

$router->get('/signup','App\Controllers\CustomerRegisterController@index');
$router->post('/signup', 'App\Controllers\CustomerRegisterController@store');