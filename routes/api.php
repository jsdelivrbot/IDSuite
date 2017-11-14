<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['middleware' => ['auth:api']], function () {



    //Entity Routes//
    Route::get('/entities/{options}', 'EntityController@getEntities');
    Route::get('/entity/{options}', 'EntityController@getEntity');

    //Endpoint Routes//
    Route::get('/endpoints/{options}', 'EndpointController@getEndpoints');
    Route::get('/endpoint/{options}', 'EndpointController@getEndpoint');
    Route::get('/endpoint/getDeviceStatus/{options}', 'EndpointController@getDeviceStatus');



    //Chart Routes//
    Route::get('/chart/callVolumeOverTime/{options}', 'ChartController@callVolumeOverTime');
    Route::get('/chart/deviceByType/{options}', 'ChartController@deviceByType');
    Route::get('/chart/deviceUpStatusAll/{options}', 'ChartController@deviceUpStatusAll');
    Route::get('/chart/deviceUpStatusPercentAll/{options}', 'ChartController@deviceUpStatusPercentAll');
    Route::get('/chart/protocolbreakout/{options}', 'ChartController@protocolBreakout');
    Route::get('/chart/deviceCostPerCallAvg/{options}', 'ChartController@deviceCostPerCallAvg');
    Route::get('/chart/devicePingData/{options}', 'ChartController@devicePingData');
    Route::get('/chart/averagecallduration/{options}', 'ChartController@averageCallDuration');
    Route::get('/chart/accountcases/{options}', 'ChartController@accountCases');
    Route::get('/chart/casesopened/{options}', 'ChartController@casesOpened');
    Route::get('/chart/totalcallduration/{options}', 'ChartController@totalCallDuration');

    //Records Routes//
    Route::get('/records/getRecords', 'APIController@getRecords');
    Route::get('/records/getRecordDetails/{options}', 'RecordController@getRecordDetails');

    Route::post('/records/insertRecords', 'APIController@insertRecords');


    //Enum Routes//
    Route::get('/enum/measure/links/{options}', 'EnumController@measureLinks');
    Route::get('/enum/modelTypeEnum/{options}', 'EnumController@modelType');
    Route::get('/enum/classCodeEnum/{options}', 'EnumController@classCode');
    Route::get('/enum/statusEnum/{options}', 'EnumController@status');
    Route::get('/enum/titleEnum/{options}', 'EnumController@title');
    Route::get('/enum/genderEnum/{options}', 'EnumController@gender');
    Route::get('/enum/phoneTypeEnum/{options}', 'EnumController@phoneType');

});
