<?php

namespace App\Http\Controllers;

use App\Endpoint;
use Illuminate\Http\Request;

class EndpointController extends Controller
{

    /**
     *
     * getEndpointsView
     *
     * Returns Endpoints view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEndpointsView()
    {
        return view('measure.endpoints', ['viewname' => 'Devices']);
    }

    /**
     *
     * getEndpoints
     *
     * returns entity objects
     *
     * @param $options
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEndpoints($options)
    {
        $options = json_decode($options);

        $this->validateObject($options);

        $endpoints = (new Endpoint)->all();
        $endpoints_array = array();
        foreach ($endpoints as $e) {
            $endpoint = new \stdClass();
            $endpoint->name = $e->name;
            $endpoint->id = $e->id;
            $endpoints_array[] = $endpoint;
        }
        return response()->json($endpoints_array);
    }


    /**
     *
     * getEndpointView
     *
     * returns endpoint view
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEndpointView($id)
    {
        $endpoint = Endpoint::getObjectById($id);
        return view('measure.endpoint', ['viewname' => 'device', 'endpoint' => $endpoint]);
    }


    /**
     *
     * getEndpoint
     *
     * returns Endpoint data
     *
     * @param $options
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEndpoint($options)
    {

        $options = json_decode($options);

        /**
         * @var Endpoint $endpoint
         */
        $endpoint = $this->validateObject($options);


        $e = new \stdClass();

        $e->entity_name = $endpoint->getEntityName();

        $e->name = $endpoint->name;

        $e->entity = $endpoint->entity;

        $e->ip = $endpoint->ipaddress;

        $e->model = $endpoint->getType();

        $e->proxy = $endpoint->getProxyName();

        $e->call_count = $endpoint->getCallCount();

        $e->average_call_duration = $endpoint->getAverageCallDuration();

        return response()->json($e);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $endpoints = Endpoint::all();


        $endpoint_array = array();

        foreach ($endpoints as $endpoint) {
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
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

        $e->model = $endpoint->model_id;
        $e->proxy = $endpoint->proxy_id;

        $account = new \stdClass();

        $account->name = $endpoint->entity->contact->name->name;
        $account->id = $endpoint->entity_id;

        $e->account = $account;


        session(['randomnumber' => rand(1, 5)]);

        if ($endpoint->type === 7) {

            return view('measure.endpoint', ['endpoint' => $e, 'name' => $e->name, 'viewname' => 'device', 'number' => session('randomnumber'), 'recordcount' => 0, 'durationaverage' => 0]);

        }

        $recordcount = count($endpoint->records);

        $duration_average = round($endpoint->analytics[2]->value, 2);

        return view('measure.endpoint', ['endpoint' => $e, 'name' => $e->name, 'viewname' => 'device', 'number' => session('randomnumber'), 'recordcount' => $recordcount, 'durationaverage' => $duration_average]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function byCustomer($id)
    {
        $customer = \App\Customer::getObjectById($id);

        $endpoints = array();

        foreach ($customer->endpoints as $endpoint) {
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
     * getDeviceStatus
     *
     * get an endpoints status
     *
     * @param $options
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDeviceStatus($options){

        $options = json_decode($options);

        /**
         * @var Endpoint $endpoint
         */
        $endpoint = $this->validateObject($options);

        if (array_key_exists('zabbix', $endpoint->references())) {

            $zabbix = new ZabbixController();

            $ref_id = $endpoint->references()['zabbix'];

            $response = $zabbix->getItemsByHost($ref_id);

            foreach ($response as $item) {

                if ($item->name === "Agent ping") {

                    if ($item->lastvalue === "1") {

                        $result = true;

                    } else {

                        $result = false;

                    }

                    $history = $zabbix->getHistory($item->itemid, $item->value_type);

                    break;

                } else {
                    continue;
                }
            }
        } else {
            $result = false;
        }

        return response()->json($result);

    }


    public function createView()
    {

        return view('measure.endpoint_create', ['viewname' => 'Create Endpoint']);

    }


}
