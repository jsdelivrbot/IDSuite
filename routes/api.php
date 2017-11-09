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

    //Chart Routes//
    Route::get('/chart/callVolumeOverTime/{options}', 'ChartController@callVolumeOverTime');
    Route::get('/chart/deviceByType/{options}', 'ChartController@deviceByType');
    Route::get('/chart/deviceUpStatusAll/{options}', 'ChartController@deviceUpStatusAll');
    Route::get('/chart/deviceUpStatusPercentAll/{options}', 'ChartController@deviceUpStatusPercentAll');
    Route::get('/chart/protocolbreakout/{options}', 'ChartController@protocolBreakout');
    Route::get('/chart/deviceCostPerCallAvg/{options}', 'ChartController@deviceCostPerCallAvg');
    Route::get('/chart/devicePingData/{options}', 'ChartController@devicePingData');
    Route::get('/chart/avergaecallduration/{options}', 'ChartController@averageCallDuration');
    Route::get('/chart/accountcases/{options}', 'ChartController@accountCases');
    Route::get('/chart/casesopened/{options}', 'ChartController@casesOpened');

    //Records Routes//
    Route::get('/records/getRecords', 'APIController@getRecords');
    Route::post('/records/insertRecords', 'APIController@insertRecords');

    //Enum Routes//
    Route::get('/enum/measure/links/{options}', 'EnumController@measureLinks');

});
