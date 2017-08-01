<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 7/25/17
 * Time: 12:39 PM
 */

namespace App\Http\Controllers;


use App\Endpoint;
use App\EndpointModel;
use App\Entity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ChartController
{

    /**
     *
     * Returns data needed to build device by type chart
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deviceByType(){

        $user = Auth::user();

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
    public function deviceUpStatusAll(){
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

        if($down_value !== 0) {
            $value = $up_value / $down_value;
        } else {
            return response()->json(['status' => false]);
        }

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
    public function deviceUpStatusPercentAll(){
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

        if($total !== 0) {
            $up_value = round(($up_value / $total) * 100);
            $down_value = round(($down_value / $total) * 100);
            $status[] = $up_value;
            $status[] = $down_value;

            return response()->json([
                'status'    => $status
            ]);

        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }


    /**
     *
     * device cost per call average
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deviceCostPerCallAvg(){
        $endpoint = Endpoint::getObjectById(session('currentendpoint'));

        $records = $endpoint->records;

        $count = 1;

        $cost = 3000;

        $label_array = array();
        $data_array = array();

        foreach ($records as $record){

            $label_array[] = $record->timeperiod->start;

            $data_array[] = $cost/$count;

            $count++;
        }

        return response()->json([
            'labels'    => $label_array,
            'data'    => $data_array
        ]);

    }



    public function devicePingData(){

        //TODO waiting for brick to give me zabbix endpoint list.
        $isAggregate    = Input::get('isAggregate');
        $id             = Input::get('isAggregate');
        $sortfield      = Input::get('isAggregate');

        ZabbixController::getHistory($id, $sortfield);


    }

}