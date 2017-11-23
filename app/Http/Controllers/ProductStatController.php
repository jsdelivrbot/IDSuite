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
     * getStats
     *
     * returns measure stats data
     *
     * @param $options
     * @return \Illuminate\Http\Response
     */
    public function getStats($options)
    {

        ini_set('memory_limit', '4096M');

        $options = json_decode($options);

        $this->validateObject($options);

        $stats = new \stdClass();

        $entities = Entity::all();

        $stats->customer_count = count($entities);

        $stats->zabbix_count = count(DynamicEnumValue::getByDynamicEnum('reference_key', EnumDataSourceType::getKeyByValue('zabbix')));

        $stats->netsuite_count = count(DynamicEnumValue::getByDynamicEnum('reference_key', EnumDataSourceType::getKeyByValue('netsuite')));

        $stats->mrge_count = count(DynamicEnumValue::getByDynamicEnum('reference_key', EnumDataSourceType::getKeyByValue('mrge')));

        $stats->polycom_count = count(DynamicEnumValue::getByDynamicEnum('reference_key', EnumDataSourceType::getKeyByValue('polycom')));

        $stats->cdr_count = count(\App\Record::all());

        $stats->cust_with_cdr = 0;

        foreach($entities as $entity){
            if(count($entity->records) > 0){
                $stats->cust_with_cdr++;
            } else {
                continue;
            }
        }

        $stats->cust_cdr_ratio = 100 * ($stats->cust_with_cdr / $stats->customer_count);




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
