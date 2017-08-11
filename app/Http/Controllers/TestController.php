<?php

namespace App\Http\Controllers;

use App\Analytic;
use App\DynamicEnum;
use App\DynamicEnumValue;
use App\Entity;
use App\EntityContact;
use App\EntityName;
use App\Enums\EnumDataSourceType;
use App\Enums\EnumDeviceType;
use App\Ip2Location;
use App\PersonContact;
use App\Record;
use App\Ticket;
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
use Faker\Provider\DateTime;
use GuzzleHttp\Psr7\Request;
use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use PhpParser\Node\Expr\AssignOp\Mod;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Symfony\Component\HttpKernel\DataCollector\DumpDataCollector;
use App\Http\Controllers\Controllers;
use App\Http\Controllers\Netsuite;


class TestController extends Controller
{


    public function test_netsuite() {

      //  NetsuiteDatabase::AddUpdateAllCustomers();

        $service = Netsuite\NetsuiteDatabase::AddUpdateAllCustomers();




    }

    public function microtime_float()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

    public function getDevParentByDevName(){
        $dev = DynamicEnumValue::getByValue('12');

        dd($dev->referable(Entity::class));

    }


    public function buildDevTicketRelationship(){
        $ticket = new Ticket();

        $ticket->save();

        $dev = new DynamicEnumValue();

        $dev->value = "SC_12312";

        $de = DynamicEnum::getByName('reference_key');

        $dev->value_type = \App\Enums\EnumDataSourceType::getKeyByValue('netsuite');

        $dev->definition($de)->save($de);

        $dev->save();

        $ticket->references($dev);

        dump($ticket->references());

        dd($dev->referable);

    }

    public function getEndpointByMpn(){
        $results = EndpointModel::getByMpn('7200-65250-001');

        dd($results);

    }


    public function getZabbixHostData(){
        $data = ZabbixController::getHosts();

        dd($data);

    }


    public function modelParsingTest(){
        $item_descriptions[] = "HDX Media Center 6000 Series w/ 1 display";

        $type_of_devices = ['cam', 'camera', 'phone', 'module', 'codec', 'softphone', 'software'];

        $model_array = array();

        foreach ($item_descriptions as $item_description) {

            $model = new \stdClass();

            $model->manufacturer = "Polycom";

            $item_description_low = strtolower($item_description);

            dump($item_description);

            if ($pos = strpos($item_description, '-')) {

                $man_modelname = trim(substr($item_description, 0, $pos), ' - ');

                dump($man_modelname);

                $p = strpos(strtolower($man_modelname), strtolower($model->manufacturer));

                if ($p !== false) {

                    $description = trim(substr($item_description, $pos, strlen($item_description)), ' - ');

                    dump($description);

                    $model_explode = explode(' ', trim($man_modelname));

                    dump($model_explode);

                    $name = $model_explode[1];


                    dump($name);


                    if (count($model_explode) > 2){
                        $edition = $model_explode[2];
                    } else {
                        $edition = null;
                    }

                    dump($edition);

                } else {

                    $model_explode = explode(' ', trim($man_modelname));

                    if(array_search(strtolower($model_explode[0]), $type_of_devices)){

                        $man_modelname = trim(substr($item_description, $pos, strlen($item_description)), ' - ');

                        $model_explode = explode(' ', trim($man_modelname));

                    }


                    $name = $model_explode[0];

                    $edition = $model_explode[1];

                    $description = ltrim(trim(substr($item_description, strlen($name) + 1 + strlen($edition), strlen($item_description))), '- ');
                }

                $type = null;

                foreach (explode(' ', preg_replace('/[^A-Za-z0-9\-]/', ' ', str_replace('-', ' ', $item_description))) as $property) {
                    $isno = false;
                    foreach ($type_of_devices as $type_of_device) {

                        if (strtolower($property) === "no") {
                            $isno = true;
                        }

                        dump('property : ' . $property . ' === ' . $type_of_device);

                        if (strtolower($property) === strtolower($type_of_device)) {
                            if (!$isno) {
                                $type = $type_of_device;
                            } else {
                                $type = null;
                            }
                        }
                    }
                }

            } elseif ($pos = strpos($item_description, ',')) {

                $man_modelname = trim(substr($item_description, 0, $pos), ' , ');

                $p = strpos(strtolower($man_modelname), strtolower($model->manufacturer));

                if ($p !== false) {

                    $description = trim(substr($item_description, $pos, strlen($item_description)), ' , ');

                    dump($description);

                    $model_explode = explode(' ', trim($man_modelname));

                    dump($model_explode);

                    $name = $model_explode[1];

                    dump($name);

                    if (count($model_explode) > 2){
                        $edition = $model_explode[2];
                    } else {
                        $edition = null;
                    }

                    dump($edition);

                } else {

                    $model_explode = explode(' ', trim($man_modelname));

                    if(array_search(strtolower($model_explode[0]), $type_of_devices)){

                        $man_modelname = trim(substr($item_description, $pos, strlen($item_description)), ' - ');

                        $model_explode = explode(' ', trim($man_modelname));

                    }

                    $name = $model_explode[0];

                    $edition = $model_explode[1];

                    $description = trim(substr($item_description, strlen($name) + 1 + strlen($edition), strlen($item_description)));
                }

                $type = null;

                foreach (explode(' ', preg_replace('/[^A-Za-z0-9\-]/', ' ', str_replace('-', ' ', $item_description))) as $property) {

                    $isno = false;

                    foreach ($type_of_devices as $type_of_device) {
                        dump('property : ' . $property . ' === ' . $type_of_device);

                        if (strtolower($property) === "no") {
                            $isno = true;
                        }

                        if (strtolower($property) === strtolower($type_of_device)) {
                            if (!$isno) {
                                $type = $type_of_device;
                            } else {
                                $type = null;
                            }
                        }
                    }
                }

            } else {

                $model_explode = explode(' ', preg_replace('/\s\s/', ' ', trim(preg_replace('/[^A-Za-z0-9\-]/', ' ', $item_description))));

                if ($p = strpos($item_description, strtolower($model->manufacturer))) {

                    $name = $model_explode[1];

                    $description = trim(substr($item_description, strlen($model_explode[0]) + 1 + strlen($name), strlen($item_description)));

                    $desc_explode = explode(' ',preg_replace('/\s\s/', ' ', trim(preg_replace('/[^A-Za-z0-9\-]/', ' ', $description))));


                } else {

                    $model_explode = explode(' ', trim($item_description));

                    $name = $model_explode[0];

                    $edition = $model_explode[1];

                    $description = trim(substr($item_description, strlen($name) + 1 + strlen($edition), strlen($item_description)));

                    $desc_explode = explode(' ',preg_replace('/\s\s/', ' ', trim(preg_replace('/[^A-Za-z0-9\-]/', ' ', $description))));
                }


                $pos_of_type = null;
                $item_count = 0;

                $type = null;

                foreach ($desc_explode as $item) {

                    foreach ($type_of_devices as $device_type) {
                        dump($item . ' === ' . $device_type);
                        if (strtolower($item) === strtolower($device_type) || $item === "no") {
                            $pos_of_type = $item_count;
                            $type = $device_type;
                            break;
                        }
                    }

                    if ($pos_of_type !== null) {
                        break;
                    } else {
                        $item_count++;
                    }
                }


                if ($pos_of_type !== null) {
                    $edition = trim(substr($description, 0, strpos($description, $desc_explode[$pos_of_type]) - 1));
                } else {
                    $type = null;
                }

            }

            $model->name = ucfirst(strtolower($name));

            $model->description = ucfirst(strtolower($description));


            if($edition !== null) {
                $model->edition = ucfirst(strtolower($edition));
            } else {
                $model->edition = $edition;
            }

            if ($type !== null) {
                $model->type = ucfirst(strtolower($type));
            } else {
                $model->type = $type;
            }

            $model_array[] = $model;

        }

        dd($model_array);
    }

    public function mapZabbixEndpointsToEndpoints(){
        ZabbixController::mapEndpoints();
    }

    public function endpointHasReference(Endpoint $endpoint, $key){

        return $endpoint->hasReference($key);

    }

    public function getDynaimcEnumsArray($de){
        return $de->values;
    }

    /**
     *
     * User $user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function test()
    {
        dd(ChartController::deviceByType());

            $this->mapZabbixEndpointsToEndpoints();

//        dd(EndpointController::getDeviceStatus());

//        dd(ZabbixController::getItemsByHost('10526'));

//        $endpoint = Endpoint::all()->first();


//        $de = DynamicEnum::getObjectById('DEN597f85c85a222');
//
//        dd($this->getDynaimcEnumsArray($de));

//        dd($this->endpointHasReference($endpoint, 'zabbix'));

        $this->mapZabbixEndpointsToEndpoints();


        dd('done');


        $model = EndpointModel::getObjectById('ENM59741f4cbfae7');

        dd($model->references());

        $ticket = Ticket::getObjectById('TIC59741d946de74');

        dd($ticket->references());

        $endpoint = Endpoint::getObjectById('END59741f4ce04b6');

        dd($endpoint->references());


//        $history = ZabbixController::getHistory('59337', 'clock');
//
//        dd($history);

//        $object = User::getObjectByID();



//        $entity = new Entity();
//        $entity->save();
//
//
//        $array = [0 => "Zabbix", 1 => "NetSuite", 2 => "MRGE"];
//
//        $de = new DynamicEnum();
//
//        $de->name = "Reference_Type";
//
//        $de->setValues($array);
//
//        $de->save();
//
//        $dev1 = new DynamicEnumValue();
//
//        $dev1->save();
//
//        $dev1->value_type = 1;
//
//        $dev1->value = $array[$dev1->value_type];
//
//        $dev1->definition($de)->save($de);
//
//        $dev1->save();
//
//        $dev2 = new DynamicEnumValue();
//
//        $dev2->save();
//
//        $dev2->value_type = 1;
//
//        $dev2->value = $array[$dev2->value_type];
//
//        $dev2->definition($de)->save($de);
//
//        $dev2->save();
//
//        $entity->references = $dev1;
//
//        $entity->references = $dev2;
//
//        $entity->save();
//
//        dd($entity);

//        $ip = '172.16.0.134';
//
//        dump($ip);
//
//
//        $loc = Ip2Location::getByIp($ip);
//
//        dd($loc);


        $params = array(
            "user"      => "mrge_api",
            "password"  => "Awa8BeUbnEw8hY"
        );

        $headers = array(
            'content-type' => 'application/json'
        );

        $body = json_encode([
            "jsonrpc" => "2.0",
            "method"=> "user.login",
            "params"=> $params,
            "id"=> 1,
            "auth"=> null
        ]);


        $url = 'https://innobidsnms2.e-idsolutions.local/zabbix/api_jsonrpc.php';

        $client = new \GuzzleHttp\Client(['verify' => false]);

        $request = new \GuzzleHttp\Psr7\Request('POST', $url, $headers, $body);

        $results = json_decode($client->send($request)->getBody()->getContents());

        $auth_token = $results->result;

        dump($results);


        $params = array(
            "output"    => "extend",
            "history"   => 0,
            "itemids"   => "59337",
            "sortfield" => "clock",
            "sortorder" => "DESC",
            "limit"     => 100
        );

        $headers = array(
            'content-type' => 'application/json'
        );

        $body = json_encode([
            "jsonrpc" => "2.0",
            "method"=> "history.get",
            "params"=> $params,
            "id"=> 1,
            "auth"=> $auth_token
        ]);

        $url = 'https://innobidsnms2.e-idsolutions.local/zabbix/api_jsonrpc.php';

        $client = new \GuzzleHttp\Client(['verify' => false]);

        $request = new \GuzzleHttp\Psr7\Request('POST', $url, $headers, $body);

        $results = json_decode($client->send($request)->getBody()->getContents());

        foreach($results->result as $result){

            if($result->value < 100){

                dump($result->itemid);
                dump($result->clock);
                dump($result->value);
            }

        }

        dd($results);


        $request = $client->createRequest("POST", $url, [
            'json' => $body
        ]);


        $response = $client->send($request);

        dd($response->getBody());

        $request = new Request();
        dd($request->url());
        $request->setUrl('https://innobidsnms2.e-idsolutions.local/zabbix/api_jsonrpc.php');
        $request->setMethod(HTTP_METH_POST);

//        $request->setHeaders(array(
//            'postman-token' => '00b0117a-84af-5373-8aba-3c5184d12034',
//            'cache-control' => 'no-cache',
//            'content-type' => 'application/x-www-form-urlencoded'
//        ));

        $request->setContentType('application/x-www-form-urlencoded');
        $request->setPostFields(null);

        try {
            $response = $request->send();

            dd($response->getBody());
        } catch (HttpException $ex) {
            echo $ex;
        }

        dd('done');


        $url = 'https://innobidsnms2.e-idsolutions.local/zabbix/api_jsonrpc.php';

        $params = array(
            'user'      =>  'mrge_api',
            'password'  =>  'Awa8BeUbnEw8hY'
        );


        $data = array();

        $post_parameters = array(
            'jsonrpc'       =>  '2.0',
            'method'        =>  'user.login',
            'params'        =>  $params,
            'id'            =>  '1',
            'auth'          =>  null
        );

        $post_parameters = json_encode($post_parameters);

//        $post_parameters = http_build_query($post_parameters, '', '&');

        $request_url = $url . $post_parameters;

        dd($request_url);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        $response = json_decode($response);

        dd($response);


        $ticket = Ticket::getObjectById('TIC59675cd57ae4a');

        dd(intval(floor($ticket->duration()/60/60/24)));


        die("test controller");
//        $records = Record::all();
//
//        dd($records);

//        $record = Record::getObjectById('REC595f920b2fbe6');
//
//        $record->process();
//
//        dd('done');

	    $endpoint = Endpoint::getObjectById('END5964d88ec88bd');

	    foreach ($endpoint->records as $record){
	        dump($record->timeperiod->duration);

	        if($record->timeperiod->duration < 0){
	            dump($record);
	            dd($record->timeperiod);
            }
        }

	    dd($endpoint->records);

        $start_time = $this->microtime_float();
        $recordcount = count($endpoint->records);

        $duration_total = 0;

        foreach ($endpoint->records as $record){
            $duration_total = $duration_total + $record->timeperiod->duration;
        }

        $duration_average = $duration_total/$recordcount;


        $end_time = $this->microtime_float();

        dump($duration_average);
        dump($end_time - $start_time );

        $start_time = $this->microtime_float();

        dump($endpoint->analytics[2]->value);

        $end_time = $this->microtime_float();

        dd($end_time - $start_time);

        $analytic = Analytic::getObjectById('ANA595d30ce4ccec');

	    dd(!is_null($analytic->numerator) && !is_null($analytic->denominator));

	    $entityname = new EntityName();

	    $entityname->name = 'test';

	    $entityname->save();

	    $entitycontact = new EntityContact();

	    $entitycontact->save();

        $entitycontact->entityname($entityname)->save($entityname);

        $entitycontact->save();

        dd($entityname->entitycontact);


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
