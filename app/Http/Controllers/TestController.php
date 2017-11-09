<?php

namespace App\Http\Controllers;

use Aloha\Twilio\TwilioInterface;
use App\Analytic;
use App\AnalyticTotalCallRecords;
use App\DynamicEnum;
use App\DynamicEnumValue;
use App\Entity;
use App\EntityContact;
use App\EntityName;
use App\Enums\EnumDataSourceType;
use App\Enums\EnumDeviceType;
use App\Enums\EnumMonths;
use App\Http\Controllers\API\APIController;
use App\Http\Controllers\Vidyo\VidyoController;
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
use NetSuite\Classes\EntityType;
use PhpParser\Node\Expr\AssignOp\Mod;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Symfony\Component\HttpKernel\DataCollector\DumpDataCollector;
use App\Http\Controllers\Controllers;
use App\Http\Controllers\Netsuite;
use App\Http\Controllers\Polycom;


class TestController extends Controller
{


    public  function test_vidyo () {


        $polycom = new Vidyo\VidyoController('portal.idsflame.com', 'cdraccess','ids_14701', 'portal2');

        $cdr_rows = $polycom->grabCDR();

        dd($cdr_rows);

        VidyoController::grabCDR();

    }

    public function add_proxy_endpoint()
    {

        // ids proxy: PRX59fb7e4b7912a
        //ids entity:  ENT59fb752109f59


        /*
        $proxy = new Proxy();
        $proxy->name = "idsolution";
        $proxy->address = "localhost";
        $proxy->port = "80";
        $proxy->token = "token";
        $entity = Entity::getByName("IDSolutions");
        $proxy->entity($entity);
        $res = $proxy->save();

        dd($proxy);
*/
        $endpoint = new Endpoint();
        $endpoint->entity();
        $endpoint->proxy(Proxy::getObjectById("PRX59fb7e4b7912a"));
        $endpoint->name = "portal.idsflame.com";
        $endpoint->ipaddress = "portal.idsflame.com";
        $res = $endpoint->save();

        dd($endpoint);
    }

    public function test_api() {

        $cdr_record = json_decode("{
			\"CallID\": 645957,
			\"UniqueCallID\": \"2108459514204460\",
			\"ConferenceName\": \"Racine1@hhcppo.idvideophone.com\",
			\"TenantName\": \"ids\",
			\"ConferenceType\": \"C\",
			\"EndpointType\": \"D\",
			\"CallerID\": \"pmoser\",
			\"CallerName\": \"Patrick Moser\",
			\"JoinTime\": \"2017-11-01 11:23:17\",
			\"LeaveTime\": \"2017-11-01 11:25:17\",
			\"CallState\": \"COMPLETED\",
			\"Direction\": \"O\",
			\"RouterID\": \"EMQS678A3WWUDRYPBGD3U6V3RB6158EE9E1NAKZY2CW9600VR0001\",
			\"GWID\": null,
			\"GWPrefix\": null,
			\"ReferenceNumber\": \"\",
			\"ApplicationName\": \"VidyoDesktop\",
			\"ApplicationVersion\": \"TAG_VD_3_6_9_014\",
			\"ApplicationOs\": \"Mac OS\",
			\"DeviceModel\": \"iMac17,1\",
			\"EndpointPublicIPAddress\": \"184.55.135.86\",
			\"CallCompletionCode\": \"1\",
			\"Extension\": \"1962819\",
			\"EndpointGUID\": \"A86-2F4E5B3A0D6C056D-E3D4C74CAA52D2AD\",
			\"AccessType\": \"U\",
			\"RoomType\": \"M\",
			\"RoomOwner\": \"Racine1\"
		}");


        $result = APIController::searchidsflame($cdr_record);
        dd($result);
    }

    public  function test_polycom () {

        /*
        RPRM – 10.0.14.87 (innobidsrprm1.e-idsolutions.local) port 8443
                      User: IDS\your domain username (IDS\fbreidi)
                      Pass: your domain password

        RPDMA – 10.0.14.85 (innobidsrpdma1.e-idsolutions.local) port 8443
                      User: fbreidi
                      Pass: ids_14701

        conferences:
        meeting in a room. can include 1 or more devices

        calls:
        direct user to user


            unzip
        CONFLIST_DETAIL_ALL_CSV-14.csv
        ENDPOINT_CDR_DETAIL_ALL_CSV-13.csv
         * */


        $polycom = new Polycom\PolycomController('https://10.0.14.87:8443/api/rest/billing', 'IDS\fbreidi', 'openinternet');

        $cdr_rows = $polycom->grabCDR();

        dd($cdr_rows);

    }


    public function test_netsuite() {


        $output =   Netsuite\NetsuiteDatabase::AddUpdateAllCustomers(6895);


   //     $service = Netsuite\NetsuiteDatabase::AddUpdateAllCustomers();




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

        $dev = \App\DynamicEnumValue::getByValue("29168");

        if($dev === null)
            echo "is null";


                $entity= $dev->referable(\App\Entity::class);
                $this->record->entity($entity);
    }


    public function addCustomersToUser(){

    }

    /**
     * @param $entity
     * @param $endpoint
     */
    public function createEndpointsFromZabbix(&$entity, &$endpoint)
    {
        $zabbix = new ZabbixController();

        $hosts = $zabbix->getHosts();

        $count = 0;

        foreach ($hosts as $host) {

            $count++;

            echo $count . PHP_EOL;

            if (substr($host->host, 0, 3) === 'UOI') {
                $entity = Entity::getByName('University of Iowa Medical Center');
                $endpoint = new Endpoint();
                $endpoint->name = $host->host;
                $endpoint->type = EnumDataSourceType::getKeyByValue('hms');

                $de = DynamicEnum::getByName('reference_key');

                $dev = new DynamicEnumValue();
                $dev->definition($de)->save($de);
                $dev->value = $host->hostid;
                $dev->value_type = EnumDataSourceType::getKeyByValue('zabbix');

                $dev->save();

                $endpoint->references($dev);


                $endpoint->entity($entity)->save($entity);
                $endpoint->save();

            }
            continue;
        }

        dd('jobs done');
    }
}
