<?php

namespace App\Http\Controllers;

use App\DynamicEnumValue;
use App\Entity;
use App\Enums\EnumDataSourceType;
use App\Http\Controllers\Helper\Prepare\Record;
use Illuminate\Http\Request;

class ProductStatController extends Controller
{


    /**
     *
     * getStatsView
     *
     * return measure stats view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getStatsView()
    {
        return view('measure.stats', ['viewname' => 'Product Statistics']);
    }

    /**
     *
     * getCustomerStats
     *
     * returns measure stats data
     *
     * @param $options
     * @return \Illuminate\Http\Response
     */
    public function getCustomerStats($options)
    {

        ini_set('memory_limit', '4096M');

        $options = json_decode($options);

        $this->validateObject($options);

        $stats = new \stdClass();

        $entities = Entity::all();

        $stats->stat = count($entities);

        return response()->json($stats);
    }

    /**
     *
     * getZabbixStats
     *
     * returns measure stats data
     *
     * @param $options
     * @return \Illuminate\Http\Response
     */
    public function getZabbixStats($options)
    {

        ini_set('memory_limit', '4096M');

        $options = json_decode($options);

        $this->validateObject($options);

        $stats = new \stdClass();

        $stats->stat = count(DynamicEnumValue::getByDynamicEnum('reference_key', EnumDataSourceType::getKeyByValue('zabbix')));

        return response()->json($stats);
    }

    /**
     *
     * getNetSuiteStats
     *
     * returns measure stats data
     *
     * @param $options
     * @return \Illuminate\Http\Response
     */
    public function getNetSuiteStats($options)
    {

        ini_set('memory_limit', '4096M');

        $options = json_decode($options);

        $this->validateObject($options);

        $stats = new \stdClass();

        $stats->stat = count(DynamicEnumValue::getByDynamicEnum('reference_key', EnumDataSourceType::getKeyByValue('netsuite')));

        return response()->json($stats);
    }

    /**
     *
     * getMrgeStats
     *
     * returns measure stats data
     *
     * @param $options
     * @return \Illuminate\Http\Response
     */
    public function getMrgeStats($options)
    {

        ini_set('memory_limit', '4096M');

        $options = json_decode($options);

        $this->validateObject($options);

        $stats = new \stdClass();

        $stats->stat = count(DynamicEnumValue::getByDynamicEnum('reference_key', EnumDataSourceType::getKeyByValue('mrge')));

        return response()->json($stats);
    }

    /**
     *
     * getPolycomStats
     *
     * returns measure stats data
     *
     * @param $options
     * @return \Illuminate\Http\Response
     */
    public function getPolycomStats($options)
    {

        ini_set('memory_limit', '4096M');

        $options = json_decode($options);

        $this->validateObject($options);

        $stats = new \stdClass();

        $stats->stat = count(DynamicEnumValue::getByDynamicEnum('reference_key', EnumDataSourceType::getKeyByValue('polycom')));

        return response()->json($stats);
    }

    /**
     *
     * getCdrStats
     *
     * returns measure stats data
     *
     * @param $options
     * @return \Illuminate\Http\Response
     */
    public function getCdrStats($options)
    {

        ini_set('memory_limit', '4096M');

        $options = json_decode($options);

        $this->validateObject($options);

        $stats = new \stdClass();

        $stats->stat = \App\Record::getRecordCount();

        return response()->json($stats);
    }

    /**
     *
     * getCustomerWithCdrStats
     *
     * returns measure stats data
     *
     * @param $options
     * @return \Illuminate\Http\Response
     */
    public function getCustomerWithCdrStats($options)
    {

        ini_set('memory_limit', '4096M');

        $options = json_decode($options);

        $this->validateObject($options);

        $stats = new \stdClass();

        $stats->stat = \App\Record::getEntityCountWithRecords();

        return response()->json($stats);
    }

    /**
     *
     * getCustomerCdrRatioStats
     *
     * returns measure stats data
     *
     * @param $options
     * @return \Illuminate\Http\Response
     */
    public function getCustomerCdrRatioStats($options)
    {

        ini_set('memory_limit', '4096M');

        $options = json_decode($options);

        $this->validateObject($options);

        $stats = new \stdClass();

        $cust_with_cdr = \App\Record::getEntityCountWithRecords();

        $total_customer = \App\Entity::all();

        $stats->stat = 100 * ($cust_with_cdr / $total_customer);

        return response()->json($stats);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
