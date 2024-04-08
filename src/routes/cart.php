<?php
$router->get('/checkout/cart', 'App\Controllers\CartController@index');
$router->post('/add/cart', 'App\Controllers\CartController@store');
