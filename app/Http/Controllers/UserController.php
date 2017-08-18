<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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


    public function getCurrentUser(){


	    $authuser = Auth::user();

	    if($authuser !== null){
	        $user = new \stdClass();
	        $user->id = $authuser->id;
	        $user->email = $authuser->email_address;
	        $user->fullname = $authuser->contact->name->first_name . ' ' . $authuser->contact->name->last_name;
            return response()->json($user);
        } else {
	        return response()->json(false);
        }


    }



    public function getUsers(){

        $users = User::all();

        $user_array = array();

        foreach($users as $user){
            $u = new \stdClass();

            $u->fullname = $user->contact->name->first_name . ' ' . $user->contact->name->last_name;
            $u->id = $user->id;

            $user_array[] = $u;

        }

        return response()->json($user_array);

    }

}
