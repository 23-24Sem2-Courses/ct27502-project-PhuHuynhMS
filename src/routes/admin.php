<?php

$router->get('/admin', 'App\Controllers\AdminProductController@index');
$router->get('/product_alter/id=(\d+)', 'App\Controllers\AdminProductController@edit');
$router->post('/product/changes', 'App\Controllers\AdminProductController@update');
$router->get('/admin/add', 'App\Controllers\AdminProductController@create');
$router->post('/admin/add', 'App\Controllers\AdminProductController@add');
$router->get('/product_del/id=(\d+)', 'App\Controllers\AdminProductController@destroy');
$router->get('/admin/invoice', 'App\Controllers\AdminInvoiceController@index');
$router->get('/admin/invoice/detail/id=(\d+)', 'App\Controllers\AdminInvoiceController@show');
$router->post('/invoice/pass', 'App\Controllers\AdminInvoiceController@update');
$router->post('/admin/invoice/filter', '\App\Controllers\AdminInvoiceController@find');
$router->post('/admin/invoice/delete', '\App\Controllers\AdminInvoiceController@destroy');

