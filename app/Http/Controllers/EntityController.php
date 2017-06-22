<?php

namespace App\Http\Controllers;

use App\Entity;
use App\User;
use App\EntityContact;
use App\EntityName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

//        $user = User::getObjectById($user->id);
//
//        $accounts = $user->orderAccountsByName();

        $accounts = $user->accounts;

        $accounts_array = array();

        foreach ($accounts as $a){
            $account    = new \stdClass();
            $contact    = EntityContact::getObjectById($a->contact_id);
            $name       = EntityName::getObjectById($contact->entityname_id);

            $account->name  = $name->name;
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
        $entity = Entity::getObjectById($id);

        $contact = EntityContact::getObjectById($entity->contact_id);

        $name = EntityName::getObjectById($contact->entityname_id);

        return view('account', [ 'name' => $name->name, 'id' => $id, 'viewname' => $name->name]);
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
