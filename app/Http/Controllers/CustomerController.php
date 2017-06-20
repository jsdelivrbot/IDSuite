<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/13/17
 * Time: 8:43 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer');
    }


    public function all(Request $request){


//        dd('tewst');


        $user = Auth::user();

        $customers = array();

        foreach ($user->customers as $customer){
            $contact = \App\Contact::getObjectById($customer->contact_id);

            $name = \App\PersonName::getObjectById($contact->personname_id);

            $c = new \stdClass();

            $c->id = $customer->id;
            $c->name = $name->preferred_name;

            $customers[] = $c;
        }

        return response()->json($customers);

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
        $customer = \App\Customer::getObjectById($id);

        $contact = \App\Contact::getObjectById($customer->contact_id);

        $name = \App\PersonName::getObjectById($contact->personname_id);

        $customer = new \stdClass();

        $customer->id = $id;
        $customer->name = $name->preferred_name;

        return view('customer', ['customer' => $customer]);

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
