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

                    if ($user->id !== $child->user->id){

                        $account = new \stdClass();
                        $account->name = $child->contact->name->name;
                        $account->id = $child->id;

                        $accounts_array[] = $account;
                    }
                }
            }

            $account  = new \stdClass();

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

        return view('account', ['name' => $name->name, 'tickets' => $entity->tickets, 'id' => $id, 'viewname' => 'account', 'sites' => $sites_array, 'persons' => $persons_array, 'notes' => $notes_array , 'number' => session('randomnumber')]);
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
