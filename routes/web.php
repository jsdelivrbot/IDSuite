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

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', 'UserController@login');



Route::get('/index', function(){
	return view('index');
});

Route::get('/cdr', function(){
	return view('cdr_reporting');
});

Route::get('/reports', function(){
	return view('reports');
});

Route::get('/endpoints', function(){
	return view('endpoints');
});

Route::get('/proxies', function(){
	return view('proxies');
});

Route::get('/customers', function(){
	return view('customers');
});

Route::get('/alerts', function(){
	return view('alerts');
});




// test routes //

Route::get('/test-data', 'TestController@testData');

Route::get('/test', 'TestController@test');