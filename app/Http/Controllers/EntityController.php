<?php

namespace App\Http\Controllers;

use App\EndpointModel;
use App\Entity;
use App\User;
use App\EntityContact;
use App\EntityName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntityController extends Controller
{

    public $randomnumber;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $accounts = $user->accounts;

        $accounts_array = array();

        foreach ($accounts as $a) {

            if (count($a->children) > 0) {
                foreach ($a->children as $child) {
                    $account = new \stdClass();
                    $account->name = $child->contact->name->name;
                    $account->id = $child->id;

                    $accounts_array[] = $account;
                }
            }

            $account    = new \stdClass();

            $account->name  = $a->contact->name->name;
            $account->id    = $a->id;

            $accounts_array[] = $account;
        }

        return view('accounts', ['accounts' => $accounts_array, 'viewname' => 'Accounts']);

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
        session(['currentaccount' => $id]);

        $entity = Entity::getObjectById($id);

        $name = $entity->contact->name;

        $sites = $entity->sites;

        $sites_array = array();



        foreach ($sites as $s){

            $site = new \stdClass();

            $l = $s->location;

            $site->address = $l->address;
            $site->city = $l->city;
            $site->state = $l->state;
            $site->zip = $l->zipcode;
            $site->name = $s->name->name;



            if($s->email->address !== "") {
                $site->email = $s->email->address;
            } else {
                $site->email = "Email is not listed.";
            }


            if($s->phonenumber->number !== null) {
                $site->number = $s->phonenumber->number;
            } else{
                $site->number = "Number is not listed.";
            }

            $sites_array[] = $site;
        }

        $persons_array = array();

        if(count($entity->persons) > 0) {
            foreach ($entity->persons as $p) {

                $person = new \stdClass();

                $person->fullname = $p->personname->first_name . ' ' . $p->personname->last_name;

                $person->number = $p->phonenumber->number;

                $person->address = $p->location->address;

                $person->city = $p->location->city;
                $person->state = $p->location->state;
                $person->zip = $p->location->zipcode;

                $persons_array[] = $person;

            }
        }

        $notes_array = array();



        foreach ($entity->notes->sortByDesc('created_at') as $n){

            $note = new \stdClass();

            $note->text = $n->text;
            $note->created = $n->created_at;

            $notes_array[] = $note;
        }

        session(['randomnumber' => rand(1,5)]);

        return view('account', ['name' => $name->name, 'id' => $id, 'viewname' => 'account', 'sites' => $sites_array, 'persons' => $persons_array, 'notes' => $notes_array , 'number' => session('randomnumber')]);
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


        if($total !== 0) {
            $up_value = round(($up_value / $total) * 100);
            $down_value = round(($down_value / $total) * 100);
            $status[] = $up_value;
            $status[] = $down_value;

            return response()->json([
                'status'    => $status
            ]);

        } else{
            return response()->json([
                'status'    => false
            ]);
        }



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
