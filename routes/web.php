<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api/v1/'], function ($router) {

    /**
     * Routes for resource auth
     */
    $router->post('login','AuthsController@authenticate');
    $router->post('valid','AuthsController@valid');

    $router->post('dte','FacturadorController@dte');
    $router->post('estado','FacturadorController@estado');

    $router->post('invoice','CertificacionController@invoice');
    $router->post('exchange-reception','CertificacionController@exchange_reception');
    $router->post('exchange-shipping','CertificacionController@exchange_shipping');
    $router->post('exchange-result','CertificacionController@exchange_result');

    $router->get('products/{id}','ProductController@get');
    $router->post('products','ProductController@add');
    $router->get('products','ProductController@all');
    $router->get('products-all','ProductController@todo');//con nombre de empresa
    $router->put('products/{id}','ProductController@put');
    $router->delete('products/{id}','ProductController@remove');
    $router->get('enterprises','EnterpriseController@all');
    //$router->post('customer','CustomerController@getData');
    //$router->get('customer/{id}','CustomerController@get');

    $router->post('enterprises','EnterpriseController@add');
    $router->put('enterprises/{id}','EnterpriseController@put');
    $router->get('enterprises/{id}','EnterpriseController@get');
    $router->delete('enterprises/{id}','EnterpriseController@remove');


    $router->post('customers','CustomerController@add');
    $router->put('customers/{id}','CustomerController@put');
    $router->get('customers/{id}','CustomerController@get');
    $router->get('customers','CustomerController@all');
    $router->delete('customers/{id}','CustomerController@remove');

    $router->get('customers-all','CustomerController@todo'); //con nombre de empresa
//    $router->post('shopping-book','FacturadorController@shopping_book');
//    $router->post('sales-book','FacturadorController@sales_book');
//
//    $router->get('get-pruebas','FacturadorController@getPruebas');
//    $router->get('obtener-semilla','FacturadorController@obtenerSemilla');
//    $router->get('obtener-token','FacturadorController@obtenerToken');
//    $router->get('get-firma','FacturadorController@getFirma');

});





