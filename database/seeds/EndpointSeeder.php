<?php
use Illuminate\Database\Seeder;
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/27/17
 * Time: 1:26 PM
 */

class EndpointSeeder extends Seeder{

    public function run(){

        $this->processProxies();

        $this->processEndpointModels();

        $this->cleanUpEndpointData();

        $this->processEndpoints();


    }


    public function cleanUpEndpointData(){
        $endpoint_file_name = 'data_imports/endpoint.csv';
        $endpoint_csv = file_get_contents($endpoint_file_name);
        $endpoints = array_map("str_getcsv", explode("\n", $endpoint_csv));

        $endpoints_array = array();

        $customer_file_name = 'data_imports/customer.csv';
        $customer_csv = file_get_contents($customer_file_name);
        $customers = array_map("str_getcsv", explode("\n", $customer_csv));


        $proxy_file_name = 'data_imports/endpoint_proxy.csv';
        $proxy_csv = file_get_contents($proxy_file_name);
        $proxies = array_map("str_getcsv", explode("\n", $proxy_csv));

        $model_file_name = 'data_imports/endpoint_model.csv';
        $model_csv = file_get_contents($model_file_name);
        $models = array_map("str_getcsv", explode("\n", $model_csv));

        $count = 0;

        $progress_count = 0;

        foreach ($endpoints as $endpoint){

            $progress = round(100 * ($count / count($endpoints)));

            if ($progress >= 0 && $progress < 10) {
                echo "Cleaning : [*---------]  $progress% \r";
            } elseif ($progress >= 10 && $progress < 20) {
                echo "Cleaning : [**--------]  $progress% \r";
            } elseif ($progress >= 20 && $progress < 30) {
                echo "Cleaning : [***-------]  $progress% \r";
            } elseif ($progress >= 30 && $progress < 40) {
                echo "Cleaning : [****------]  $progress% \r";
            } elseif ($progress >= 40 && $progress < 50) {
                echo "Cleaning : [*****-----]  $progress% \r";
            } elseif ($progress >= 50 && $progress < 60) {
                echo "Cleaning : [******----]  $progress% \r";
            } elseif ($progress >= 60 && $progress < 70) {
                echo "Cleaning : [*******---]  $progress% \r";
            } elseif ($progress >= 70 && $progress < 80) {
                echo "Cleaning : [********--]  $progress% \r";
            } elseif ($progress >= 80 && $progress < 90) {
                echo "Cleaning : [*********-]  $progress% \r";
            } elseif ($progress >= 90 && $progress < 100) {
                echo "Cleaning : [**********]  $progress% \r";
            } else {
                if($progress_count === 0) {
                    echo "Cleaning : [**********]  $progress% \n";
                    $progress_count++;
                }
            }

            if($count === 0 || $endpoint[0] === null){
                $count++;
                continue;
            }


//            dd($models);

            $customer_index = $endpoint[1];

            $customer_row = $customers[$customer_index];

            $customer_name = $customer_row[1];

            $endpoint[1] = $customer_name;

            $proxy_index = $endpoint[10];



            if($proxy_index > 0){
                $proxy_row = $proxies[$proxy_index];

                $proxy_name = $proxy_row[2];

                $endpoint[10] = $proxy_name;


            } else {
                $count++;
            }

            $model_index = $endpoint[3];


            switch ($model_index){

                case "Room":
                    $model_index = 1;
                    $endpoint[18] = $models[$model_index][4];
                    break;
                case "Room 220":
                    $model_index = 2;
                    $endpoint[18] = $models[$model_index][4];
                    break;
                case "Room 220i":
                    $model_index = 3;
                    $endpoint[18] = $models[$model_index][4];
                    break;
                case "Icon 600":
                    $model_index = 4;
                    $endpoint[18] = $models[$model_index][4];
                    break;
                case "UVC ClearSea":
                    $model_index = 5;
                    $endpoint[18] = 0;
                    break;
                case "UVC Multipoint":
                    $model_index = 6;
                    $endpoint[18] = $models[$model_index][4];
                    break;
                case "Group 500":
                    $model_index = 7;
                    $endpoint[18] = $models[$model_index][4];
                    break;

                default:
                    $model_index = 0;
                    $endpoint[18] = 0;
                break;
            }

            $endpoints_array[] = $endpoint;

        }


        $file_input = fopen('data_imports/cleaned_endpoints.csv', "w");

        foreach ($endpoints_array as $row) {
            fputcsv($file_input, $row);
        }

        fclose($file_input);

    }

    public function processProxies(){

        $file_name = 'data_imports/endpoint_proxy.csv';

        $csv = file_get_contents($file_name);

        $proxies = array_map("str_getcsv", explode("\n", $csv));

        $count = 0;

        $progress_count = 0;

        foreach ($proxies as $p) {


            $progress = round(100 * ($count / count($proxies)));

            if ($progress >= 0 && $progress < 10) {
                echo "Proxies : [*---------]  $progress% \r";
            } elseif ($progress >= 10 && $progress < 20) {
                echo "Proxies : [**--------]  $progress% \r";
            } elseif ($progress >= 20 && $progress < 30) {
                echo "Proxies : [***-------]  $progress% \r";
            } elseif ($progress >= 30 && $progress < 40) {
                echo "Proxies : [****------]  $progress% \r";
            } elseif ($progress >= 40 && $progress < 50) {
                echo "Proxies : [*****-----]  $progress% \r";
            } elseif ($progress >= 50 && $progress < 60) {
                echo "Proxies : [******----]  $progress% \r";
            } elseif ($progress >= 60 && $progress < 70) {
                echo "Proxies : [*******---]  $progress% \r";
            } elseif ($progress >= 70 && $progress < 80) {
                echo "Proxies : [********--]  $progress% \r";
            } elseif ($progress >= 80 && $progress < 90) {
                echo "Proxies : [*********-]  $progress% \r";
            } elseif ($progress >= 90 && $progress < 100) {
                echo "Proxies : [**********]  $progress% \r";
            } else {
                if($progress_count === 0) {
                    echo "Proxies : [**********]  $progress% \n";
                    $progress_count++;
                }
            }


            if($count === 0 || $p[0] === null || $p[1] === 'bs') {
                $count++;
                continue;
            }

            $proxy = new \App\Proxy();


            $proxy->save();


            $dynamic_enum_value = new \App\DynamicEnumValue();

            $dynamic_enum_value->save();

//            $dynamic_enum_value->definition(DatabaseSeeder::$dynamic_enum)->save(DatabaseSeeder::$dynamic_enum);

            $dynamic_enum = \App\DynamicEnum::getByName('reference_key');

            $dynamic_enum_value->definition($dynamic_enum)->save($dynamic_enum);

            $dynamic_enum_value->value = $p[0];

            $dynamic_enum_value->value_type = \App\Enums\EnumDataSourceType::getKeyByValue('mrge');

            $dynamic_enum_value->save();

            $proxy->references($dynamic_enum_value);

            $proxy->save();


            $proxy->name    = $p[2];
            $proxy->address = $p[3];
            $proxy->port    = $p[4];
            $proxy->target  = null;
            $proxy->token   = $p[6];
            $proxy->pkey    = $p[7];

            $proxy->save();

            $entity = static::processEntity($p[1]);

            if(is_object($entity)){
                $proxy->entity($entity)->save($entity);
                $proxy->save();
            } else {
                dump($p[1]);
                dump($entity);
                dd('$entity not an object');
            }

            $ip2location = \App\Ip2Location::getByIp($proxy->address);

            if($ip2location !== null){
                $coordinate = new \App\Coordinate();
                $coordinate->lng = $ip2location->longitude;
                $coordinate->lat = $ip2location->latitude;
                $coordinate->save();


                $location = new \App\Location();
                $location->save();

                $location->address = null;
                $location->city =$ip2location->city_name;
                $location->state =$ip2location->region_name;
                $location->zipcode =$ip2location->zip_code;
                $location->country_code = $ip2location->country_code;
                $location->time_zone = $ip2location->time_zone;
                $location->coordinate($coordinate)->save($coordinate);
                $location->save();

            } else {
                $coordinate = new \App\Coordinate();
                $coordinate->save();

                $location = new \App\Location();
                $location->save();

                $location->coordinate($coordinate)->save($coordinate);

            }

            $proxy->location($location)->save($location);

            $proxy->save();

            $count++;

        }
    }


    public function processEndpointModels(){

        $file_name = 'data_imports/endpoint_model_price.csv';

        $csv = file_get_contents("$file_name");

        $models = array_map("str_getcsv", explode("\n", $csv));

        $count = 0;

        $progress_count = 0;

        foreach ($models as $m){


            $progress = round(100 * ($count / count($models)));

            if ($progress >= 0 && $progress < 10) {
                echo "NetSuite Models : [*---------]  $progress% \r";
            } elseif ($progress >= 10 && $progress < 20) {
                echo "NetSuite Models : [**--------]  $progress% \r";
            } elseif ($progress >= 20 && $progress < 30) {
                echo "NetSuite Models : [***-------]  $progress% \r";
            } elseif ($progress >= 30 && $progress < 40) {
                echo "NetSuite Models : [****------]  $progress% \r";
            } elseif ($progress >= 40 && $progress < 50) {
                echo "NetSuite Models : [*****-----]  $progress% \r";
            } elseif ($progress >= 50 && $progress < 60) {
                echo "NetSuite Models : [******----]  $progress% \r";
            } elseif ($progress >= 60 && $progress < 70) {
                echo "NetSuite Models : [*******---]  $progress% \r";
            } elseif ($progress >= 70 && $progress < 80) {
                echo "NetSuite Models : [********--]  $progress% \r";
            } elseif ($progress >= 80 && $progress < 90) {
                echo "NetSuite Models : [*********-]  $progress% \r";
            } elseif ($progress >= 90 && $progress < 100) {
                echo "NetSuite Models : [**********]  $progress% \r";
            } else {
                if($progress_count === 0) {
                    echo "NetSuite Models : [**********]  $progress% \n";
                    $progress_count++;
                }
            }


            if ($count === count($models) - 1 || $m[0] === "" || $m[1] === "" || $m[2] === "") {
                $count++;
                continue;
            }

            $model = new \App\EndpointModel();

            $model->save();

            $model->manpnumber = $m[0];

            $model->manufacturer = $m[1];

            $item_description = $m[2];

            if ($pos = strpos($item_description, '-')) {

                $man_modelname = trim(substr($item_description, 0, $pos), ' - ');

//                dump($man_modelname);

                $p = strpos(strtolower($man_modelname), strtolower($model->manufacturer));

                if ($p !== false) {

                    $description = trim(substr($item_description, $pos, strlen($item_description)), ' - ');

//                    dump($description);

                    $model_explode = explode(' ', trim($man_modelname));

//                    dump($model_explode);

                    $name = $model_explode[1];


//                    dump($name);


                    if (count($model_explode) > 2){
                        $edition = $model_explode[2];
                    } else {
                        $edition = null;
                    }

//                    dump($edition);

                } else {

                    $model_explode = explode(' ', trim($man_modelname));

                    if(array_search(strtolower($model_explode[0]), \App\Enums\EnumDeviceType::getValues())){

                        $man_modelname = trim(substr($item_description, $pos, strlen($item_description)), ' - ');

                        $model_explode = explode(' ', trim($man_modelname));
                    }

                    $name = $model_explode[0];

//                    dump($man_modelname);

//                    dump($count);


//                    dump($model_explode);

                    $edition = $model_explode[1];

                    $description = ltrim(trim(substr($item_description, strlen($name) + 1 + strlen($edition), strlen($item_description))), '- ');
                }

                $type = null;

                foreach (explode(' ', preg_replace('/[^A-Za-z0-9\-]/', ' ', str_replace('-', ' ', $item_description))) as $property) {
                    $isno = false;
                    foreach (\App\Enums\EnumDeviceType::getValues() as $type_of_device) {

                        if (strtolower($property) === "no") {
                            $isno = true;
                        }

//                        dump('property : ' . $property . ' === ' . $type_of_device);

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

//                    dump($description);

                    $model_explode = explode(' ', trim($man_modelname));

//                    dump($model_explode);

                    $name = $model_explode[1];

//                    dump($name);

                    if (count($model_explode) > 2){
                        $edition = $model_explode[2];
                    } else {
                        $edition = null;
                    }

//                    dump($edition);

                } else {

                    $model_explode = explode(' ', trim($man_modelname));

                    if(array_search(strtolower($model_explode[0]), \App\Enums\EnumDeviceType::getValues())){

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

                    foreach (\App\Enums\EnumDeviceType::getValues() as $type_of_device) {
//                        dump('property : ' . $property . ' === ' . $type_of_device);

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

                    foreach (\App\Enums\EnumDeviceType::getValues() as $device_type) {
//                        dump($item . ' === ' . $device_type);
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
//                    $edition = trim($description);
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
                $model->type = \App\Enums\EnumDeviceType::getKeyByValue(ucfirst(strtolower($type)));
            } else {
                $model->type = $type;
            }

            $model->price = floatval(preg_replace('/,/', '', $m[3]));


            $model->save();

            $dynamic_enum_value = new \App\DynamicEnumValue();

            $dynamic_enum_value->save();

            $dynamic_enum = \App\DynamicEnum::getByName('reference_key');

            $dynamic_enum_value->definition($dynamic_enum)->save($dynamic_enum);

            $dynamic_enum_value->value = $m[4];

            $dynamic_enum_value->value_type = \App\Enums\EnumDataSourceType::getKeyByValue('mrge');

            $dynamic_enum_value->save();

            $model->references($dynamic_enum_value);

            $model->save();

            $count++;

        }
    }


    public function processEndpoints(){

        $file_name = 'data_imports/cleaned_endpoints.csv';

        $csv = file_get_contents("$file_name");

        $endpoints = array_map("str_getcsv", explode("\n", $csv));

        $count = 0;

        $progress_count = 0;

        foreach ($endpoints as $e) {

            $progress = round(100 * ($count / count($endpoints)));

            if ($progress >= 0 && $progress < 10) {
                echo "Endpoints : [*---------]  $progress% \r";
            } elseif ($progress >= 10 && $progress < 20) {
                echo "Endpoints : [**--------]  $progress% \r";
            } elseif ($progress >= 20 && $progress < 30) {
                echo "Endpoints : [***-------]  $progress% \r";
            } elseif ($progress >= 30 && $progress < 40) {
                echo "Endpoints : [****------]  $progress% \r";
            } elseif ($progress >= 40 && $progress < 50) {
                echo "Endpoints : [*****-----]  $progress% \r";
            } elseif ($progress >= 50 && $progress < 60) {
                echo "Endpoints : [******----]  $progress% \r";
            } elseif ($progress >= 60 && $progress < 70) {
                echo "Endpoints : [*******---]  $progress% \r";
            } elseif ($progress >= 70 && $progress < 80) {
                echo "Endpoints : [********--]  $progress% \r";
            } elseif ($progress >= 80 && $progress < 90) {
                echo "Endpoints : [*********-]  $progress% \r";
            } elseif ($progress >= 90 && $progress < 100) {
                echo "Endpoints : [**********]  $progress% \r";
            } else {
                if($progress_count === 0) {
                    echo "Endpoints : [**********]  $progress% \n";
                    $progress_count++;
                }
            }


            if($e[0] === null || $e[10] === "0"){
                $count++;
                continue;
            }

            $endpoint  = new \App\Endpoint();

            $endpoint->save();

            $dynamic_enum_value = new \App\DynamicEnumValue();

            $dynamic_enum_value->save();

            $dynamic_enum = \App\DynamicEnum::getByName('reference_key');

            $dynamic_enum_value->definition($dynamic_enum)->save($dynamic_enum);

            $dynamic_enum_value->value = $e[0];

            $dynamic_enum_value->value_type = \App\Enums\EnumDataSourceType::getKeyByValue('mrge');

            $dynamic_enum_value->save();

            $endpoint->references($dynamic_enum_value);

            $endpoint->save();

            $entity = static::processEntity($e[1]);

            if(!$entity){
                continue;
            } else {
                $endpoint->entity($entity)->save($entity);
            }

            $proxy = static::processProxy($e[10]);

            $endpoint->proxy($proxy)->save($proxy);

            $endpoint->save();

            $model = static::processModel($e[18]);

            if($model !== false){
                $endpoint->endpointmodel($model)->save($model);
            }



            $endpoint->save();




            $ip2location = \App\Ip2Location::getByIp($e[8]);

            if($ip2location->latitude !== 0.0 && $ip2location->longitude !== 0.0) {
                $coordinate = new \App\Coordinate();
                $coordinate->lng = $ip2location->longitude;
                $coordinate->lat = $ip2location->latitude;
                $coordinate->save();


                $location = new \App\Location();
                $location->save();

                $location->address = null;
                $location->city =$ip2location->city_name;
                $location->state =$ip2location->region_name;
                $location->zipcode =$ip2location->zip_code;
                $location->country_code = $ip2location->country_code;
                $location->time_zone = $ip2location->time_zone;

                $location->coordinate($coordinate)->save($coordinate);

                $location->save();

                $endpoint->location($location)->save($location);

            } else {

            //    $endpoint->location($proxy->location)->save($proxy->location);

            }

            $endpoint->save();

            $endpoint->username = $e[5];

            $endpoint->setPassword($e[6]);

            $endpoint->name = $e[7];

            $endpoint->ipaddress = $e[8];

            $endpoint->macaddress = $e[9];

            $endpoint->sync_time = $e[11];

            $endpoint->reboot_time = $e[12];

            $endpoint->last_reboot = $e[13];


            if($e[15] === "d"){
                $endpoint->status = \App\Enums\EnumStatusType::getKeyByValue('down');
            } elseif ($e[15] === "u"){
                $endpoint->status = \App\Enums\EnumStatusType::getKeyByValue('up');
            }



            $endpoint->status_at = $e[16];

            $endpoint->active = $e[17];

            $endpoint->save();

            $mrge_id = $e[0];

            $smrge_id = $endpoint->id;

            $endpoint_map = $mrge_id . ',' . $smrge_id;

            file_put_contents('data_imports/x_mrge_endpoints_smrge_endpoints.csv', $endpoint_map.PHP_EOL , FILE_APPEND);



            $count_records_analytic = new \App\Analytic();

            $count_records_analytic->save();

            $count_records_analytic->analytic_type = \App\Enums\EnumAnalyticType::getKeyByValue('Count');

            $count_records_analytic->analytic_object_class = \App\Record::class;

            $count_records_analytic->analytic_object_relationship = null;

            $count_records_analytic->analytic_object_property = "id";

            $count_records_analytic->name = 'Total Call Data Records';

            $count_records_analytic->value = 0;

            $count_records_analytic->stringvalue = null;

            $count_records_analytic->save();

            $count_records_analytic->endpoint($endpoint)->save($endpoint);

            $count_records_analytic->save();



            $total_call_time_analytic = new \App\Analytic();

            $total_call_time_analytic->save();

            $total_call_time_analytic->analytic_type = \App\Enums\EnumAnalyticType::getKeyByValue('Total');

            $total_call_time_analytic->analytic_object_class = \App\Record::class;

            $total_call_time_analytic->analytic_object_relationship = "timeperiod";

            $total_call_time_analytic->analytic_object_property = "duration";

            $total_call_time_analytic->name = 'Total Call Duration';

            $total_call_time_analytic->value = 0;

            $total_call_time_analytic->stringvalue = null;

            $total_call_time_analytic->save();

            $total_call_time_analytic->endpoint($endpoint)->save($endpoint);

            $total_call_time_analytic->save();



            $average_call_time_analytic = new \App\Analytic();

            $average_call_time_analytic->save();

            $average_call_time_analytic->analytic_type = \App\Enums\EnumAnalyticType::getKeyByValue('division');

            $average_call_time_analytic->analytic_object_class = \App\Record::class;

            $average_call_time_analytic->analytic_object_relationship = null;

            $average_call_time_analytic->analytic_object_property = null;

            $average_call_time_analytic->name = 'Average Call Duration';

            $average_call_time_analytic->denominator($count_records_analytic)->save($count_records_analytic);

            $average_call_time_analytic->numerator($total_call_time_analytic)->save($total_call_time_analytic);

            $average_call_time_analytic->value = 0;

            $average_call_time_analytic->stringvalue = null;

            $average_call_time_analytic->save();

            $average_call_time_analytic->endpoint($endpoint)->save($endpoint);

            $average_call_time_analytic->save();



            $most_common_local_name_analytic = new \App\Analytic();

            $most_common_local_name_analytic->save();

            $most_common_local_name_analytic->analytic_type = \App\Enums\EnumAnalyticType::getKeyByValue('frequent');

            $most_common_local_name_analytic->analytic_object_class = \App\Record::class;

            $most_common_local_name_analytic->analytic_object_relationship = null;

            $most_common_local_name_analytic->analytic_object_property = "local_name";

            $most_common_local_name_analytic->name = "Most Frequent Local Name";

            $most_common_local_name_analytic->value = null;

            $most_common_local_name_analytic->stringvalue = null;

            $most_common_local_name_analytic->save();

            $most_common_local_name_analytic->endpoint($endpoint)->save($endpoint);

            $most_common_local_name_analytic->save();


            $count++;

        }
    }


    public static function processEntity($entity_name){
        $entity = \App\Entity::getByName($entity_name);

        if($entity === null) {
            return false;
        } else {
            return $entity;
        }
    }

    public static function processProxy($proxy_name){
        $proxy = \App\Proxy::getByName($proxy_name);
        if($proxy === null){
            return false;
        } else {
            return $proxy;
        }
    }

    public static function processModel($model_mpn){
        $model = \App\EndpointModel::getByMpn($model_mpn);

        if($model === null){
            return false;
        } else {
            return $model;
        }
    }
}