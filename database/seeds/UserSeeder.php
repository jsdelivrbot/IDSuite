<?php
use Illuminate\Database\Seeder;
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/13/17
 * Time: 4:49 PM
 */

class UserSeeder extends Seeder
{
    public $user_id;

    public $customer_id;

    public function run() {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 1000; $i++) {

            $email_address = $faker->email;

            $email = new App\Email();

            $email->setEmail($email_address);


            $address = $faker->address;

            $explode_address = explode("\n", $address);
            $street_address = $explode_address[0];
            $rest_of_address = explode(',', $explode_address[1]);
            $city = $rest_of_address[0];
            $rest_of_address = explode(' ', $rest_of_address[1]);
            $state = $rest_of_address[1];
            $zip = $rest_of_address[2];


            $location = new App\Location([
                'address'   =>  $street_address,
                'city'      =>  $city,
                'state'     =>  $state,
                'zipcode'   =>  $zip
            ]);

            $location->save();

            $coordinates = new App\Coordinate([
                'lat'   =>  $faker->latitude,
                'lng'   =>  $faker->longitude
            ]);

            $coordinates->save();


            $location->coordinate_id = $coordinates->id;

            $location->save();


            $first_name = $faker->firstName;

            $personname = new App\PersonName([
                'first_name'        =>  $first_name,
                'last_name'         =>  $faker->lastName,
                'middle_name'       =>  $faker->firstName,
                'preferred_name'    =>  $first_name,
                'title'             =>  $faker->title
            ]);

            $personname->save();

            $contact = new App\Contact();

            $contact->email_id = $email->id;
            $contact->location_id = $location->id;
            $contact->personname_id = $personname->id;

            $contact->save();

            $user = new App\User();
            $user->contact_id = $contact->id;
            $user->email_address = $email_address;
            $user->setPassword('ids_14701');
            $user->username = $user->getEmailUsername();
            $user->save();


            $company_email_address = $faker->companyEmail;

            $email = new App\Email();

            $email->setEmail($company_email_address);


            $address = $faker->address;

            $explode_address = explode("\n", $address);
            $street_address = $explode_address[0];
            $rest_of_address = explode(',', $explode_address[1]);
            $city = $rest_of_address[0];
            $rest_of_address = explode(' ', $rest_of_address[1]);
            $state = $rest_of_address[1];
            $zip = $rest_of_address[2];


            $location = new App\Location([
                'address'   =>  $street_address,
                'city'      =>  $city,
                'state'     =>  $state,
                'zipcode'   =>  $zip
            ]);

            $location->save();

            $coordinates = new App\Coordinate([
                'lat'   =>  $faker->latitude,
                'lng'   =>  $faker->longitude
            ]);

            $coordinates->save();


            $location->coordinate_id = $coordinates->id;

            $location->save();


            $first_name = $faker->firstName;

            $personname = new App\PersonName([
                'preferred_name'    =>  $faker->company,
            ]);

            $personname->save();

            $contact = new App\Contact();

            $contact->email_id = $email->id;
            $contact->location_id = $location->id;
            $contact->personname_id = $personname->id;

            $contact->save();

            $customer = new App\Customer();
            $customer->contact_id = $contact->id;
            $customer->email_address = $email_address;
            $customer->setPassword('ids_14701');
            $customer->username = $customer->getEmailUsername();
            $customer->save();



            $model = new App\EndpointModel([
                'manufacturer'  => 'test',
                'name'          => 'testing',
                'architecture'  => 'testy',
                'key'           => 'tey'
            ]);

            $model->save();

            $proxy = new App\Proxy([
                'address'   => '123.123.123.123',
                'name'      => 'test_proxy',
                'port'      => '30360',
                'target'    => 'test_target',
                'token'     => 'tasdfasdfasldkfjsalkf',
                'key'       => 'jalskasdfsadfaslsjfas'
            ]);

            $proxy->customer_id = $customer->id;

            $proxy->save();

            $endpoint = new App\Endpoint([
                'manufacturer'  =>  'test',
                'username'      =>  $faker->userName,
                'name'          =>  'Life_Size_device',
                'ipaddress'     =>  $faker->ipv4,
                'macaddress'    =>  $faker->macAddress,
            ]);

            $endpoint->location_id  = $location->id;
            $endpoint->customer_id  = $customer->id;
            $endpoint->model_id     = $model->id;
            $endpoint->proxy_id     = $proxy->id;

            $endpoint->setPassword('testing');

            $endpoint->save();

            if($i === 0){
                $this->user_id = $user->id;
                $this->customer_id = $customer->id;
            }

            $user = \App\User::getObjectById($this->user_id);

            $user->customers()->save($customer);

            $customer = \App\Customer::getObjectById($this->customer_id);

            $customer->endpoints()->save($endpoint);

        }

    }

}