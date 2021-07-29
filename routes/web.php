<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', ['as'=>'asd','uses' =>'Controller@index']);


$router->group(['prefix' => 'institution','middleware'=>"access"], function () use ($router) {
    $router->get('/', ['as'=>'institution','uses' =>'InstitutionController@getInstitution']);
    $router->get('/{id}', ['as'=>'institution-id','uses' =>'InstitutionController@getInstitutionId']);
    $router->post('/', ['as'=>'new-institution','uses' =>'InstitutionController@newInstitution']);
    $router->put('/{id}', ['as'=>'update-institution','uses' =>'InstitutionController@updateInstitution']);
    $router->delete('/{id}', ['as'=>'delete-institution','uses' =>'InstitutionController@deleteInstitution']);

});