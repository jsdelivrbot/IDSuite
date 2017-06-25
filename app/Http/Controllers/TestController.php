<?php

namespace App\Http\Controllers;

use App\Entity;
use App\EntityContact;
use App\PersonContact;
use App\User;
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



        $user = User::getObjectById('USR594d749828db3');

        dd($user->accounts[0]->sites[0]->location);

	    $location = new Location();

	    $location->save();

        $location_two = new Location();

        $location_two->save();

        $contact = new EntityContact();

        $contact->location($location);

        $contact->save();

        dd($contact->location);

        $contact_two = new EntityContact();

        $contact_two->save();

        $entity = new Entity();

        $entity->save();

        $entity->contact($contact_two)->save();

        $entity->save();

        dd($entity->contact);





        dd($entity);

        dd($entity->contact);

        $entity->sites()->save($contact);

        $entity->sites()->save($contact_two);

        $entity = Entity::getObjectById($entity->id);

        dump($entity->id);

        dd($entity->sites);

        $user = new User();

        $user->save();

        dump($user);

        $user->accounts()->save($entity);



        dd($user->accounts);







	    $customer = Customer::getObjectById('CUS59408640ab393');

	    dd($customer->endpoints);


	    $user = User::getObjectById('USR594079ca59746');

	    $customers = array();

	    foreach ($user->customers as $customer){

	        $contact = Contact::getObjectById($customer->contact_id);

	        $name = PersonName::getObjectById($contact->personname_id);

	        $c = new \stdClass();

	        $c->id = $customer->id;
	        $c->name = $name->preferred_name;

	        $customers[] = $c;
        }

        $response = response()->json($customers);

	    return $response;




        dump($user);
	    dd($user->customers);



        $faker = \Faker\Factory::create();

        $company_email_address = $faker->companyEmail;

        $email = new Email();

        $email->setEmail($company_email_address);


        $address = $faker->address;

        $explode_address = explode("\n", $address);
        $street_address = $explode_address[0];
        $rest_of_address = explode(',', $explode_address[1]);
        $city = $rest_of_address[0];
        $rest_of_address = explode(' ', $rest_of_address[1]);
        $state = $rest_of_address[1];
        $zip = $rest_of_address[2];


        $location = new Location([
            'address'   =>  $street_address,
            'city'      =>  $city,
            'state'     =>  $state,
            'zipcode'   =>  $zip
        ]);

        $location->save();

        $coordinates = new Coordinate([
            'lat'   =>  $faker->latitude,
            'lng'   =>  $faker->longitude
        ]);

        $coordinates->save();


        $location->coordinate_id = $coordinates->id;

        $location->save();

        $personname = new PersonName([
            'preferred_name'    =>  $faker->company,
        ]);

        $personname->save();

        $contact = new Contact();

        $contact->email_id = $email->id;
        $contact->location_id = $location->id;
        $contact->personname_id = $personname->id;

        $contact->save();

        $customer_one = new Customer();
        $customer_one->contact_id = $contact->id;
        $customer_one->email_address = $company_email_address;
        $customer_one->setPassword('ids_14701');
        $customer_one->username = $customer_one->getEmailUsername();
        $customer_one->save();



        $faker = \Faker\Factory::create();

        $company_email_address = $faker->companyEmail;

        $email = new Email();

        $email->setEmail($company_email_address);


        $address = $faker->address;

        $explode_address = explode("\n", $address);
        $street_address = $explode_address[0];
        $rest_of_address = explode(',', $explode_address[1]);
        $city = $rest_of_address[0];
        $rest_of_address = explode(' ', $rest_of_address[1]);
        $state = $rest_of_address[1];
        $zip = $rest_of_address[2];


        $location = new Location([
            'address'   =>  $street_address,
            'city'      =>  $city,
            'state'     =>  $state,
            'zipcode'   =>  $zip
        ]);

        $location->save();

        $coordinates = new Coordinate([
            'lat'   =>  $faker->latitude,
            'lng'   =>  $faker->longitude
        ]);

        $coordinates->save();


        $location->coordinate_id = $coordinates->id;

        $location->save();

        $personname = new PersonName([
            'preferred_name'    =>  $faker->company,
        ]);

        $personname->save();

        $contact = new Contact();

        $contact->email_id = $email->id;
        $contact->location_id = $location->id;
        $contact->personname_id = $personname->id;

        $contact->save();

        $customer_two = new Customer();
        $customer_two->contact_id = $contact->id;
        $customer_two->email_address = $company_email_address;
        $customer_two->setPassword('ids_14701');
        $customer_two->username = $customer_two->getEmailUsername();
        $customer_two->save();







        $email_address = $faker->email;

        $email = new Email();

        $email->setEmail($email_address);


        $address = $faker->address;

        $explode_address = explode("\n", $address);
        $street_address = $explode_address[0];
        $rest_of_address = explode(',', $explode_address[1]);
        $city = $rest_of_address[0];
        $rest_of_address = explode(' ', $rest_of_address[1]);
        $state = $rest_of_address[1];
        $zip = $rest_of_address[2];


        $location = new Location([
            'address'   =>  $street_address,
            'city'      =>  $city,
            'state'     =>  $state,
            'zipcode'   =>  $zip
        ]);

        $location->save();

        $coordinates = new Coordinate([
            'lat'   =>  $faker->latitude,
            'lng'   =>  $faker->longitude
        ]);

        $coordinates->save();


        $location->coordinate_id = $coordinates->id;

        $location->save();


        $first_name = $faker->firstName;

        $personname = new PersonName([
            'first_name'        =>  $first_name,
            'last_name'         =>  $faker->lastName,
            'middle_name'       =>  $faker->firstName,
            'preferred_name'    =>  $first_name,
            'title'             =>  $faker->title
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
        $user->setPassword('ids_14701');
        $user->username = $user->getEmailUsername();

        $user->customers()->save($customer_one);
        $user->customers()->save($customer_two);

//        $user->customer_id = $customers;
        $user->save();




        $user = User::getObjectById($user->id);

        $customers = Customer::getAllObjects();

        foreach ($customers as $customer){
            $user->customers()->save($customer);
        }


	    dd($user->customers);










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


    public function addCustomersToUser(){

    }
}
