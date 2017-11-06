<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PassportController extends Controller
{
    public function index(){

        return view('idsuite.passport', ['viewname' => 'OAuth']);

    }


    public function passportAuthorize(){

    }
}
