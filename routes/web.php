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

// Non authed routes //

Route::get('/', function(){
   return view('auth.login', ['viewname' => 'Login']);
})->name('home');



Route::get('login', function(){
    return view('auth.login', ['viewname' => 'Login']);
});

Auth::routes();

Route::post('login', 'Auth\LoginController@loginNameOrEmail');

Route::get('/getAuthUser', 'UserController@getCurrentUser');

// test routes //
Route::get('/test', 'TestController@test');
Route::get('/test/ns', 'TestController@test_netsuite');


// auth middleware //

Route::group(['middleware' => ['auth']], function () {

    // apppicker routes //

    Route::get('/apps', function(){
        return view('apppicker', ['viewname' => 'App Selection']);
    });

    // chart routes //

    Route::get('/api/deviceByType', 'ChartController@deviceByType');

    Route::get('/api/deviceUpStatusAll', 'ChartController@deviceUpStatusAll');

    Route::get('/api/deviceUpStatusPercentAll', 'ChartController@deviceUpStatusPercentAll');

    Route::get('/api/deviceCostPerCallAvg', 'ChartController@deviceCostPerCallAvg');

    Route::get('/api/devicePingData', 'ChartController@devicePingData');

    Route::get('api/chart/', 'ChartController@index');

    Route::get('api/chart/getCustomers', 'ChartController@getCustomers');

    Route::post('api/chart/vot', 'ChartController@vot');

    Route::post('api/chart/locp', 'ChartController@locp');


    // Endpoint routes //

    Route::get('/devices/{id}', 'EndpointController@show');

    Route::get('/devices' , 'EndpointController@index');

    Route::get('/getDeviceStatus', 'EndpointController@getDeviceStatus');


    // EndpointModel routes //

    Route::get('/model/{id}', 'EndpointModelController@show');


    // Entity routes //

    Route::get('/accounts', 'EntityController@index');

    Route::get('/accounts/all', 'EntityController@all');

    Route::get('/accounts/{id}', 'EntityController@show');


    // Enums Route //

    Route::get('/modelTypeEnum', 'EnumController@modelType');

    Route::get('/classCodeEnum', 'EnumController@classCode');

    Route::get('/statusEnum', 'EnumController@status');

    Route::get('/titleEnum', 'EnumController@title');

    Route::get('/genderEnum', 'EnumController@gender');

    Route::get('/phoneTypeEnum', 'EnumController@phoneType');


    // Note Routes //

    Route::post('/notes', 'NoteController@create');

    // proxy routes //

    Route::get('/proxy/{id}', 'ProxyController@show');


    // PersonContact routes //

    Route::post('/personcontacts', 'PersonContactController@create');


    // Random Number Route //

    Route::get('/getRandomNumber', 'RandomNumberController@getRandomNumber');


    // record routes //

    Route::get('/transactions', 'RecordController@index');

    Route::get('/getRecordDetails', 'RecordController@getRecordDetails');

    Route::get('/getTransactions', 'RecordController@getTransactions');


    Route::resource('datatables', 'DatatablesController', [
        'getIndex' => 'datatables'
    ]);

    Route::get('/getRecordsDataTables', 'DataTablesController@getRecordsDataTables');


    // Tickets routes //

    Route::get('/tickets', 'TicketController@index');

    Route::get('/tickets/{id}', 'TicketController@show');

    Route::get('/filter/tickets/', 'TicketController@filter');


    Route::get('/webrtc', 'WebRtcController@index');


});



