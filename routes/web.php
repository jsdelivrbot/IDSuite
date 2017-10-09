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


    Route::get('/getUsers', 'UserController@getUsers');

    // apppicker routes //

    Route::get('/apps', function(){
        return view('apppicker', ['viewname' => 'App Selection']);
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

    Route::get('api/chart/', 'ChartController@index');

    Route::get('api/chart/getCustomers', 'ChartController@getCustomers');

    Route::get('api/totalcallduration', 'ChartController@totalCallDuration');

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


    // Trust Routes //

    Route::get('trust', function(){
        return view('trust.trustdata', ['viewname' => 'Trust']);
    });



    // Medsitter Routes WebRTC Routes //

    Route::get('/medsitter', 'MedsitterController@index');

    Route::get('/medsitter/patient/{pod_id}-{participant_id}', 'MedsitterController@patient');

    Route::get('/medsitter/sitter/{id}', 'MedsitterController@sitter');

    Route::get('/medsitter/library', 'MedsitterController@library');

    Route::get('/medsitter/pods', 'MedsitterController@pod');

    Route::post('/medsitter/pod', 'MedsitterController@createPod');

    Route::post('/medsitter/participant/leave', 'MedsitterController@dropParticipant');

    Route::post('/medsitter/sitter/leave', 'MedsitterController@dropSitter');

    Route::post('/medsitter/participant', 'MedsitterController@participant');

    Route::get('/medsitter/participant/mutetoggle', 'MedsitterController@muteToggle');



//    Route::get('/webrtc', 'WebRtcController@index');
//
//
//    Route::post('/twilio', 'WebRtcController@sendMessage');
//
//    Route::post('/alltwilio', 'WebRtcController@sendMessageToAll');



    // stats routes //

    Route::get('/stats', 'ProductStatController@index');


});



