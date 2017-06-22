<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
   return view('auth.login', ['viewname' => 'Login']);
});

Route::get('login', function(){
    return view('auth.login', ['viewname' => 'Login']);
});

Auth::routes();

Route::post('login', 'Auth\LoginController@loginNameOrEmail');





//Route::get('/customer/endpoints/{id}', 'EndpointController@byCustomer');
//
//Route::get('/customer', 'CustomerController@index');
//
//Route::get('/customer/all', 'CustomerController@all');
//
//Route::get('/customer/{id}', 'CustomerController@show');


Route::get('/user/current', 'UserController@getCurrentUser');



//Route::get('/test')

// auth middleware //

Route::group(['middleware' => ['auth']], function () {

    // Enums Route //

    Route::get('/modelTypeEnum', 'EnumController@modelType');

    Route::get('/classCodeEnum', 'EnumController@classCode');

    Route::get('/statusEnum', 'EnumController@status');

    Route::get('/titleEnum', 'EnumController@title');

    Route::get('/genderEnum', 'EnumController@gender');

    // test routes //

    Route::get('/test', 'TestController@test');


    // rest routes //


    Route::get('/apps', function(){
       return view('apppicker', ['viewname' => 'App Selection']);
    });

    Route::get('/devices/{id}', 'EndpointController@show');


    Route::get('/devices' , 'EndpointController@index');


    Route::get('/proxy/{id}', 'ProxyController@show');

    Route::get('/model/{id}', 'ModelController@show');


    Route::get('/accounts/devices/{id}', 'EndpointController@byAccount');

    Route::get('/accounts', 'EntityController@index');

    Route::get('/accounts/all', 'EntityController@all');

    Route::get('/account/{id}', 'EntityController@show');



});
