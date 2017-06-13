<?php

namespace App\Http\Controllers;


use App\Contact;
use App\Coordinate;
use App\Customer;
use App\Email;
use App\Endpoint;
use App\EndpointModel;
use App\Location;
use App\Model;
use App\PersonName;
use App\Proxy;
use Mockery\Exception;
use PhpParser\Node\Expr\AssignOp\Mod;

class TestController extends Controller
{
    
	public function test(){

	    $email_address = 'aa@asd.com';

	    $email = new Email($email_address);

	    $email->save();

	    $name = new PersonName([
	       'first_name'         =>  'Alex',
            'last_name'         =>  'Mac',
            'middle_name'       =>  'Duke',
            'preferred_name'    =>  'Al',
            'title'             =>  'Mr.'
        ]);

	    $name->save();

	    $name->first_name = 'Tim';

	    $name->save();

	    $location = new Location([
            'address'       =>  '363 east greyhound pass',
            'city'          =>  'carmel',
            'state'         =>  'Indiana',
            'zipcode'       =>  '46032',
        ]);


	    $location->save();




        $location->createCoordinates();


//        $coordinate->location()->associate($location);

//        $location->coordinate()->save($coordinate);



//        dd($location);

        $location->save();

        dd($location);

        $contact = new Contact();
        $contact->lopcation = $location;
        $contact->personname = $name;
        $contact->email = $email;
        $contact->save();

        dd($contact);

//        $contact = Contact::getObjectById($contact->mrge_id);

	    $customer = new Customer();

	    $customer->contact_id = $contact->id;

	    $customer->save();

        $location = new Location([
            'address'   =>  '3740 indigo blue blvd',
            'city'      =>  'whitetown',
            'state'     =>  'Indiana',
            'zipcode'   =>  '46075'
        ]);

        $location = $location->createCoordinates();

        $model = new EndpointModel([
            'manufacturer'  => 'test',
            'name'          => 'testing',
            'architecture'  => 'testy',
            'key'           => 'tey'
        ]);

        $model->save();

        $proxy = new Proxy([
            'address'   => '123.123.123.123',
            'name'      => 'test_proxy',
            'port'      => '30360',
            'target'    => 'test_target',
            'token'     => 'tasdfasdfasldkfjsalkf',
            'key'       => 'jalskasdfsadfaslsjfas'
        ]);

        $proxy->customer_id = $customer->id;

        $proxy->save();

	    $endpoint = new Endpoint([
	        'manufacturer'  =>  'test',
            'username'      =>  'testusername',
            'name'          =>  'testname',
            'ipaddress'     =>  '123.123.123.122',
            'macaddress'    =>  'AC:AE:BC:CB',
        ]);

	    $endpoint->location_id  = $location->id;
        $endpoint->customer_id  = $customer->id;
        $endpoint->model_id     = $model->id;
        $endpoint->proxy_id     = $proxy->id;

        $endpoint->setPassword('testing');

        $endpoint->save();

        $endpoint = Endpoint::getObjectById($endpoint->id);

        return response()->json([
            'response'  =>  $endpoint
        ]);

    }
}
