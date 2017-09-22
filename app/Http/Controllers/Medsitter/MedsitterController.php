<?php

/**
 * Created by PhpStorm.
 * User: amac
 * Date: 9/12/17
 * Time: 9:59 AM
 */

namespace App\Http\Controllers;

class MedsitterController extends Controller
{
    public function index(){

        return view('Medsitter.home', ['viewname' => 'Medsitter / Home']);

    }


    public function patientview(){
        return view('Medsitter.patientview', ['viewname' => 'Medsitter / Patient']);
    }

}