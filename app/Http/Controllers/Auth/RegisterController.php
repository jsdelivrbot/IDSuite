<?php

namespace App\Http\Controllers\Auth;

use App\Email;
use App\PersonName;
use App\Location;

use App\Contact;

use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first-name' => 'required|string|max:255',
            'middle-name' => 'required|string|max:255',
            'last-name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:4|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        $email_address = $data['email'];

        $email = new Email();

        $email->setEmail($email_address);


        $location = new Location([
            'address'   =>  $data['address'],
            'city'      =>  $data['city'],
            'state'     =>  $data['state'],
            'zipcode'   =>  $data['zip']
        ]);

        $location->save();

        $location->createCoordinates();

        $personname = new PersonName([
            'first_name'        =>  $data['first-name'],
            'last_name'         =>  $data['middle-name'],
            'middle_name'       =>  $data['last-name'],
            'preferred_name'    =>  $data['preferred-name'],
            'title'             =>  $data['title']
        ]);

        $personname->save();

        $contact = new Contact();

        $contact->email_id = $email->id;
        $contact->location_id = $location->id;
        $contact->personname_id = $personname->id;

        $contact->save();

        $user = new User();
        $user->contact_id = $contact->id;
        $user->email_address = $email_address;
        $user->setPassword($data['password']);
        $user->username = $user->getEmailUsername();
        $user->save();




        return $user;
    }
}
