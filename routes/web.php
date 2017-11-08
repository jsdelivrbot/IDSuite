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
Route::get('/test/vidyo', 'TestController@test_vidyo');
Route::get('/test/add_proxy_endpoint', 'TestController@add_proxy_endpoint');

Route::get('/test', 'TestController@test');
Route::get('/test/ns', 'TestController@test_netsuite');
Route::get('/test/polycom', 'TestController@test_polycom');
Route::get('/test/api', 'TestController@test_api');

Route::get('/authenticate', 'LoginController@authenicate');
// auth middleware //

Route::group(['middleware' => ['auth']], function () {

    Route::get('/passport', 'PassportController@index');

    Route::get('/getUsers', 'UserController@getUsers');

    // apppicker routes //

    Route::get('/apps', function(){
        return view('/idsuite/apppicker', ['viewname' => 'App Selection']);
    });

    // chart routes //

    Route::get('/api/callVolumeOverTime', 'ChartController@callVolumeOverTime');

    Route::get('/api/deviceByType', 'ChartController@deviceByType');

    Route::get('/api/deviceUpStatusAll', 'ChartController@deviceUpStatusAll');

    Route::get('/api/deviceUpStatusPercentAll', 'ChartController@deviceUpStatusPercentAll');

    Route::get('/api/protocolbreakout', 'ChartController@protocolBreakout');

    Route::get('/api/deviceCostPerCallAvg', 'ChartController@deviceCostPerCallAvg');

    Route::get('/api/devicePingData', 'ChartController@devicePingData');

    Route::get('/api/avergaecallduration', 'ChartController@averageCallDuration');

    Route::get('/api/accountcases', 'ChartController@accountCases');

    Route::get('/api/casesopened', 'ChartController@casesOpened');

    Route::get('/api/chart/', 'ChartController@index');

    Route::get('/api/chart/getCustomers', 'ChartController@getCustomers');

    Route::get('/api/totalcallduration', 'ChartController@totalCallDuration');

    Route::post('/api/chart/vot', 'ChartController@vot');

    Route::post('/api/chart/locp', 'ChartController@locp');


    // Endpoint routes //

    Route::get('/measure/devices/{id}', 'EndpointController@show');

    Route::get('/measure/device/create', 'EndpointController@createView');

    Route::get('/measure/devices' , 'EndpointController@index');

    Route::get('/api/getDeviceStatus', 'EndpointController@getDeviceStatus');


    // EndpointModel routes //

    Route::get('/measure/model/{id}', 'EndpointModelController@show');


    // Entity routes //

    Route::get('/measure/accounts', 'EntityController@getEntitiesView');

    Route::get('/measure/accounts/all', 'EntityController@all');

    Route::get('/measure/accounts/{id}', 'EntityController@getEntityView');


    // Enums Route //

    Route::get('/api/modelTypeEnum', 'EnumController@modelType');

    Route::get('/api/classCodeEnum', 'EnumController@classCode');

    Route::get('/api/statusEnum', 'EnumController@status');

    Route::get('/api/titleEnum', 'EnumController@title');

    Route::get('/api/genderEnum', 'EnumController@gender');

    Route::get('/api/phoneTypeEnum', 'EnumController@phoneType');


    // Note Routes //

    Route::post('/api/notes', 'NoteController@create');

    // proxy routes //

    Route::get('/measure/proxy/{id}', 'ProxyController@show');


    // PersonContact routes //

    Route::post('/api/personcontacts', 'PersonContactController@create');


    // Random Number Route //

    Route::get('/api/getRandomNumber', 'RandomNumberController@getRandomNumber');


    // record routes //

    Route::get('/measure/transactions', 'RecordController@index');

    Route::get('/api/getRecordDetails', 'RecordController@getRecordDetails');

    Route::get('/api/getTransactions', 'RecordController@getTransactions');


    Route::resource('datatables', 'DatatablesController', [
        'getIndex' => 'datatables'
    ]);

    Route::get('/api/getRecordsDataTables', 'DataTablesController@getRecordsDataTables');


    // Tickets routes //

    Route::get('/measure/tickets', 'TicketController@index');

    Route::get('/measure/ticket/{id}', 'TicketController@show');

    Route::get('/measure/filter/tickets/', 'TicketController@filter');


    // Trust Routes //

    Route::get('/trust', function(){
        return view('trust.trustdata', ['viewname' => 'Trust']);
    });



    // medsitter Routes WebRTC Routes //

    Route::get('/medsitter', 'MedsitterController@index');


//    Route::get('/measure/webrtc', 'WebRtcController@index');
//
//
//    Route::post('/api/twilio', 'WebRtcController@sendMessage');
//
//    Route::post('/api/alltwilio', 'WebRtcController@sendMessageToAll');



    // stats routes //

    Route::get('/measure/stats', 'ProductStatController@index');


});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
