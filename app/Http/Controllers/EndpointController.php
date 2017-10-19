<?php

namespace App\Http\Controllers;

use App\Endpoint;
use Illuminate\Http\Request;

class EndpointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $endpoints = Endpoint::all();

        $endpoint_array = array();

        foreach($endpoints as $endpoint) {
            $e = new \stdClass();

            $e->id = $endpoint->id;
            $e->name = $endpoint->name;
            $e->ip = $endpoint->ipaddress;
            $e->mac = $endpoint->macaddress;
            $e->model = $endpoint->model_id;
            $e->proxy = $endpoint->proxy_id;

            $endpoint_array[] = $e;

        }

        return view('measure.endpoints', ['endpoints' => $endpoint_array, 'viewname' => 'Devices']);
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
        session(['currentendpoint' => $id]);

        $endpoint = Endpoint::getObjectById($id);

        session(['currentendpointobject' => $endpoint]);

        $e = new \stdClass();

        $e->id = $endpoint->id;
        $e->name = $endpoint->name;
        $e->ip = $endpoint->ipaddress;
        $e->mac = $endpoint->macaddress;
        $e->model = $endpoint->model_id;
        $e->proxy = $endpoint->proxy_id;

        $account = new \stdClass();

        $account->name = $endpoint->entity->contact->name->name;
        $account->id = $endpoint->entity_id;

        $e->account = $account;


        session(['randomnumber' => rand(1,5)]);

        $recordcount = count($endpoint->records);

        $duration_average = round($endpoint->analytics[2]->value, 2);

        return view('measure.endpoint', ['endpoint' => $e,'name' => $e->name, 'viewname' => 'device', 'number' => session('randomnumber'), 'recordcount' => $recordcount, 'durationaverage' => $duration_average]);
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

    public function byCustomer($id){
        $customer = \App\Customer::getObjectById($id);

        $endpoints = array();

        foreach ($customer->endpoints as $endpoint){
            $e = new \stdClass();

            $e->id = $endpoint->id;
            $e->name = $endpoint->name;
            $e->ip = $endpoint->ipaddress;
            $e->mac = $endpoint->macaddress;
            $e->model = $endpoint->model_id;
            $e->proxy = $endpoint->proxy_id;

            $endpoints[] = $e;
        }

        return view('endpoints', ['endpoints' => $endpoints]);
    }


    /**
     *
     * get an endpoints status
     *
     */
    public function getDeviceStatus(){

        $endpoint = session('currentendpointobject');


        if(array_key_exists( 'zabbix' ,$endpoint->references())){
            $response = ZabbixController::getItemsByHost($endpoint->references()['zabbix']);

            if($response[6]->lastvalue === "1"){
                $result = true;
            } else {
                $result = false;
            }

        } else {
            $result = false;

        }

        return response()->json($result);

    }


}
