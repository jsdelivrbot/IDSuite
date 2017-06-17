<?php

namespace App\Http\Controllers;

use App\Proxy;
use Illuminate\Http\Request;

class ProxyController extends Controller
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

        $proxy = Proxy::getObjectById($id);

        $p = new \stdClass();

        $p->id = $proxy->id;
        $p->name = $proxy->name;
        $p->ip = $proxy->address;
        $p->port = $proxy->port;
        $p->target = $proxy->target;
        $p->key = $proxy->key;
        $p->token = $proxy->token;


        $proxy = array();

        $proxy[] = $p;

        return view('proxy', ['proxy' => $proxy]);

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

            $endpoints[] = $e;
        }

        return view('endpoints', ['endpoints' => $endpoints]);
    }
}
