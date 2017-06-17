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
   return view('auth.login');
});

Auth::routes();

Route::post('login', 'Auth\LoginController@loginNameOrEmail');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');



Route::get('/endpoint/{id}', 'EndpointController@show');


Route::get('/endpoint' , 'EndpointController@index');


Route::get('/proxy/{id}', 'ProxyController@show');

Route::get('/model/{id}', 'ModelController@show');



Route::get('/customer/endpoints/{id}', 'EndpointController@byCustomer');

Route::get('/customer', 'CustomerController@index');

Route::get('/customer/all', 'CustomerController@all');

Route::get('/customer/{id}', 'CustomerController@show');


Route::get('/user/current', 'UserController@getCurrentUser');



Route::get('/titleEnum', 'EnumController@title');

Route::get('/genderEnum', 'EnumController@gender');

Route::get('/test', 'TestController@test');

//Route::get('/test')

// auth middleware //

Route::group(['middleware' => ['auth']], function () {

    // Enums Route //

    Route::get('/modelTypeEnum', 'EnumController@modelType');

    Route::get('/classCodeEnum', 'EnumController@classCode');

    Route::get('/statusEnum', 'EnumController@status');

    // test routes //


});
