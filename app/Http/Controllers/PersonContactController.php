<?php

namespace App\Http\Controllers;

use App\Email;
use App\Entity;
use App\PersonContact;
use App\PersonName;
use App\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PersonContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entity_id = session('currentaccount');

        $entity = Entity::getObjectById($entity_id);

        $firstname = Input::get('firstname');
        $middlename = Input::get('middlename');
        $lastname = Input::get('lastname');
        $preferredname = Input::get('preferredname');
        $title = Input::get('title');
        $email_address = Input::get('email');
        $phonenumber = Input::get('phonenumber');
        $phonetype = Input::get('phonetype');



        $personcontact = new PersonContact();

        $personname = new PersonName();

        $personname->first_name = $firstname;
        $personname->last_name = $lastname;
        $personname->middle_name = $middlename;
        $personname->preferred_name = $preferredname;
        $personname->title = $title;

        $personname->save();

        $email = new Email();
        $email->setEmail($email_address);

        $pnumber = new PhoneNumber($phonenumber, $phonetype);

        $pnumber->save();



        $personcontact->location($entity->contact->location)->save($entity->contact->location);
        $personcontact->name($personname)->save($personname);
        $personcontact->email($email)->save($email);
        $personcontact->phonenumber($pnumber)->save($pnumber);

        $personcontact->save();

        $entity->persons()->save($personcontact);

        return response()->json([
            'data'  => $personcontact
        ]);
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
