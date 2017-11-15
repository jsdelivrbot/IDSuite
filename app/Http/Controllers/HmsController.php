<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HmsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $accounts = $user->accounts;

        $accounts_array = array();

        foreach ($accounts as $a) {

            if (count($a->children) > 0) {

                foreach ($a->children as $child) {

                    if($child->user !== null) {

                        if ($user->id !== $child->user->id) {

                            $account = new \stdClass();
                            $account->name = $child->contact->name->name;
                            $account->id = $child->id;

                            $accounts_array[] = $account;
                        }
                    }
                }
            }

            $account  = new \stdClass();

            $account->name  = $a->contact->name->name;
            $account->id    = $a->id;

            $accounts_array[] = $account;
        }

        return view('hms.accounts', ['accounts' => $accounts_array, 'viewname' => 'Accounts']);

    }
}
