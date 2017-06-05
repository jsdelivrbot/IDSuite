<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{


	public function login()
    {

		\Log::debug('we are in UserController');

		return response()->json([
    		'code' 		=> '200',
		    'message' 	=> 'Successful login'
		]);
    }

}
