<?php

namespace App\Http\Controllers;

use App\DynamicEnumValue;
use App\Entity;
use App\Enums\EnumDataSourceType;
use Illuminate\Http\Request;

class ProductStatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $customer_count = count(Entity::all());


        $zabbix_count = count(DynamicEnumValue::getByDynamicEnum('reference_key', EnumDataSourceType::getKeyByValue('zabbix')));

        $netsuite_count = count(DynamicEnumValue::getByDynamicEnum('reference_key', EnumDataSourceType::getKeyByValue('netsuite')));

        $mrge_count = count(DynamicEnumValue::getByDynamicEnum('reference_key', EnumDataSourceType::getKeyByValue('mrge')));

        $polycom_count = count(DynamicEnumValue::getByDynamicEnum('reference_key', EnumDataSourceType::getKeyByValue('polycom')));


        $viewname = 'Product Statistics';

        return view('stats', compact('customer_count', 'zabbix_count', 'netsuite_count', 'mrge_count', 'polycom_count', 'viewname'));
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
