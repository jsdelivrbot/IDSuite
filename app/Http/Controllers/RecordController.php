<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 7/7/17
 * Time: 11:38 AM
 */

namespace App\Http\Controllers;


use App\Record;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class RecordController
{
    public $randomnumber;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('measure.transactions', ['viewname' => 'Transactions']);
    }

    public function getTransactions(){
        $user = Auth::user();

        $records = array();

        foreach ($user->accounts as $account){

            if(count($account->endpoints) > 0){
                foreach ($account->endpoints as $endpoint){
                    if(count($endpoint->records) > 0 ){
                        foreach ($endpoint->records as $record){
                            $records[] = $record;
                        }
                    }
                }
            }
        }
        return view('measure.transactions', ['viewname' => 'Transactions']);
    }

    public function getRecordDetails(){
        $id = Input::get('id');

        $record = Record::getObjectById($id);

        $timeperiod = new \stdClass();

        $timeperiod->start = $record->timeperiod->start;
        $timeperiod->end = $record->timeperiod->end;
        $timeperiod->duration = $record->timeperiod->duration;

        $r = new \stdClass();

        $r->endpoint_id = $record->endpoint_id;
        $r->id = $record->id;
        $r->timeperiod = $timeperiod;
        $r->local_id = $record->local_id;
        $r->conference_id = $record->conference_id;
        $r->local_name = $record->local_name;
        $r->local_number = $record->local_number;
        $r->remote_name = $record->remote_name;
        $r->remote_number = $record->remote_number;
        $r->dialed_digits = $record->dialed_digits;
        $r->direction = $record->direction;
        $r->protocol = $record->protocol;


        if($record->remote_location->coordinate->lat !== $record->endpoint->location->coordinate->lat && $record->remote_location->coordinate->lng !== $record->endpoint->location->coordinate->lng) {
            $r->remote_lat = $record->remote_location->coordinate->lat;
            $r->remote_lng = $record->remote_location->coordinate->lng;
            $r->local_lat = $record->endpoint->location->coordinate->lat;
            $r->local_lng = $record->endpoint->location->coordinate->lng;
        } else {
            $r->remote_lat = $record->remote_location->coordinate->lat + .00002;
            $r->remote_lng = $record->remote_location->coordinate->lng + .00002;
            $r->local_lat = $record->endpoint->location->coordinate->lat;
            $r->local_lng = $record->endpoint->location->coordinate->lng;
        }

        return response()->json($r);

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
     * @param String $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }


    /**
     *
     * Returns data needed to build device by type chart
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChartDeviceByType(){
        $entity = Entity::getObjectById(session('currentaccount'));

        $endpoints = $entity->endpoints;

        $models = EndpointModel::getAllModels();

        $model_names_value_array = array();

        $names = array();

        $values = array();

        foreach ($models as $model){

            $m = new \stdClass();

            $m->name = $model->name;
            $m->value = 0;

            $model_names_value_array[] = $m;
        }

        foreach ($endpoints as $endpoint){
            foreach ($model_names_value_array as $name) {
                if($endpoint->endpointmodel->name === $name->name){
                    $name->value = $name->value + 1;
                }
            }
        }

        foreach ($model_names_value_array as $name_val){
            $names[] = $name_val->name;
            $values[] = $name_val->value;
        }

        return response()->json([
            'names'     => $names,
            'values'    => $values
        ]);

    }


    /**
     *
     * returns data needed to build device up status for all devices chart
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChartDeviceUpStatusAll(){
        $entity = Entity::getObjectById(session('currentaccount'));

        $endpoints = $entity->endpoints;

        $up_value = 0;

        $down_value = 0;

        $status = array();

        foreach ($endpoints as $endpoint){
            if($endpoint->status === 'u'){
                $up_value++;
            } else {
                $down_value++;
            }
        }

        $status[] = $up_value;
        $status[] = $down_value;

        $value = $up_value/$down_value;

        return response()->json([
            'status'    => $status,
            'value'     => $value
        ]);

    }


    /**
     *
     * returns data needed to build device up status for all devices chart
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChartDeviceUpStatusPercentAll(){
        $entity = Entity::getObjectById(session('currentaccount'));

        $endpoints = $entity->endpoints;

        $up_value = 0;

        $down_value = 0;

        $status = array();

        foreach ($endpoints as $endpoint){
            if($endpoint->status === 'u'){
                $up_value++;
            } else {
                $down_value++;
            }
        }



        $total = $up_value + $down_value;

        $up_value = round(($up_value/$total) * 100);
        $down_value = round(($down_value/$total) * 100);

        $status[] = $up_value;
        $status[] = $down_value;

        return response()->json([
            'status'    => $status
//            'up'        => $up_value,
//            'down'      => $down_value
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function edit(Entity $entity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entity $entity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entity $entity)
    {
        //
    }
}