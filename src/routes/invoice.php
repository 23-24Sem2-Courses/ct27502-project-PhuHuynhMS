<?php 

$router->get('/checkout/order', 'App\Controllers\DetailController@index');
$router->post('/checkout/order', 'App\Controllers\DetailController@index');
// $router->get('/order/invoice', 'App\Controllers\InvoiceController@index');
$router->post('/checkout/confirmation', 'App\Controllers\InvoiceController@store');
$router->get('/checkout/confirmation', 'App\Controllers\InvoiceController@index');
$router->post('/invoice/delete', 'App\Controllers\InvoiceController@destroy');


