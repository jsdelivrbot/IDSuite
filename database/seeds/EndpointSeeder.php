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

        $this->cleanUpEndpointData();

        $this->processProxies();

        $this->processEndpointModels();

        $this->processEndpoints();


    }


    public function cleanUpEndpointData(){
        $endpoint_file_name = 'endpoint.csv';
        $endpoint_csv = file_get_contents($endpoint_file_name);
        $endpoints = array_map("str_getcsv", explode("\n", $endpoint_csv));

        $endpoints_array = array();

        $customer_file_name = 'customer.csv';
        $customer_csv = file_get_contents($customer_file_name);
        $customers = array_map("str_getcsv", explode("\n", $customer_csv));


        $proxy_file_name = 'endpoint_proxy.csv';
        $proxy_csv = file_get_contents($proxy_file_name);
        $proxies = array_map("str_getcsv", explode("\n", $proxy_csv));


        $count = 0;

        foreach ($endpoints as $endpoint){

            $progress = round(100 * ($count / count($endpoints)));

            if ($progress > 0 && $progress < 10) {
                echo "cleaning : [*---------]  $progress% \r";
            } elseif ($progress > 10 && $progress < 20) {
                echo "cleaning : [**--------]  $progress% \r";
            } elseif ($progress > 20 && $progress < 30) {
                echo "cleaning : [***-------]  $progress% \r";
            } elseif ($progress > 30 && $progress < 40) {
                echo "cleaning : [****------]  $progress% \r";
            } elseif ($progress > 40 && $progress < 50) {
                echo "cleaning : [*****-----]  $progress% \r";
            } elseif ($progress > 50 && $progress < 60) {
                echo "cleaning : [******----]  $progress% \r";
            } elseif ($progress > 60 && $progress < 70) {
                echo "cleaning : [*******---]  $progress% \r";
            } elseif ($progress > 70 && $progress < 80) {
                echo "cleaning : [********--]  $progress% \r";
            } elseif ($progress > 80 && $progress < 90) {
                echo "cleaning : [*********-]  $progress% \r";
            } elseif ($progress > 90 && $progress < 100) {
                echo "cleaning : [**********]  $progress% \r";
            }

            if($count === 0 || $endpoint[0] === null){
                $count++;
                continue;
            }


            $customer_index = $endpoint[1];

            $customer_row = $customers[$customer_index];

            $customer_name = $customer_row[1];

            $endpoint[1] = $customer_name;

            $proxy_index = $endpoint[10];

            if($proxy_index > 0){
                $proxy_row = $proxies[$proxy_index];

                $proxy_name = $proxy_row[2];

                $endpoint[10] = $proxy_name;

                $endpoints_array[] = $endpoint;
            } else {
                $count++;
            }
        }

        $file_input = fopen('cleaned_endpoints.csv', "w");

        foreach ($endpoints_array as $row) {
            fputcsv($file_input, $row);
        }

        fclose($file_input);

    }

    public function processProxies(){

        $file_name = 'endpoint_proxy.csv';

        $csv = file_get_contents($file_name);

        $proxies = array_map("str_getcsv", explode("\n", $csv));

        $count = 0;

        foreach ($proxies as $p) {


            $progress = round(100 * ($count / count($proxies)));

            if ($progress > 0 && $progress < 10) {
                echo "proxies : [*---------]  $progress% \r";
            } elseif ($progress > 10 && $progress < 20) {
                echo "proxies : [**--------]  $progress% \r";
            } elseif ($progress > 20 && $progress < 30) {
                echo "proxies : [***-------]  $progress% \r";
            } elseif ($progress > 30 && $progress < 40) {
                echo "proxies : [****------]  $progress% \r";
            } elseif ($progress > 40 && $progress < 50) {
                echo "proxies : [*****-----]  $progress% \r";
            } elseif ($progress > 50 && $progress < 60) {
                echo "proxies : [******----]  $progress% \r";
            } elseif ($progress > 60 && $progress < 70) {
                echo "proxies : [*******---]  $progress% \r";
            } elseif ($progress > 70 && $progress < 80) {
                echo "proxies : [********--]  $progress% \r";
            } elseif ($progress > 80 && $progress < 90) {
                echo "proxies : [*********-]  $progress% \r";
            } elseif ($progress > 90 && $progress < 100) {
                echo "proxies : [**********]  $progress% \r";
            }


            if($count === 0 || $p[0] === null || $p[1] === 'bs') {


                $count++;
                continue;
            }

            $proxy = new \App\Proxy();

            $proxy->name    = $p[2];
            $proxy->address = $p[3];
            $proxy->port    = $p[4];
            $proxy->target  = null;
            $proxy->token   = $p[6];
            $proxy->key     = $p[7];

            $proxy->save();

            $entity = static::processEntity($p[1]);

            if(is_object($entity)){
                $proxy->entity($entity)->save($entity);
                $proxy->save();
            } else {
                dd('$entity not an object');
            }
            $location = new \App\Location();

            $location->save();

            $coordinate = new \App\Coordinate();

            $coordinate->save();

            $location->coordinate($coordinate)->save($coordinate);

            $location->save();

            $proxy->location($location)->save($location);

            $proxy->save();

            $count++;

        }
    }


    public function processEndpointModels(){

        $file_name = 'endpoint_model.csv';

        $csv = file_get_contents("$file_name");

        $models = array_map("str_getcsv", explode("\n", $csv));

        $count = 0;

        foreach ($models as $m){


            $progress = round(100 * ($count / count($models)));

            if ($progress > 0 && $progress < 10) {
                echo "models : [*---------]  $progress% \r";
            } elseif ($progress > 10 && $progress < 20) {
                echo "models : [**--------]  $progress% \r";
            } elseif ($progress > 20 && $progress < 30) {
                echo "models : [***-------]  $progress% \r";
            } elseif ($progress > 30 && $progress < 40) {
                echo "models : [****------]  $progress% \r";
            } elseif ($progress > 40 && $progress < 50) {
                echo "models : [*****-----]  $progress% \r";
            } elseif ($progress > 50 && $progress < 60) {
                echo "models : [******----]  $progress% \r";
            } elseif ($progress > 60 && $progress < 70) {
                echo "models : [*******---]  $progress% \r";
            } elseif ($progress > 70 && $progress < 80) {
                echo "models : [********--]  $progress% \r";
            } elseif ($progress > 80 && $progress < 90) {
                echo "models : [*********-]  $progress% \r";
            } elseif ($progress > 90 && $progress < 100) {
                echo "models : [**********]  $progress% \r";
            }

            if($count === 0 || $m[0] === null){
                $count++;
                continue;
            }

            $model = new \App\EndpointModel();

            $series = explode(' ', $m[2]);

            $model->manufacturer    = $m[1];
            $model->name            = $m[2];
            $model->architecture    = $m[3];
            $model->series          = $series[0];

            $model->save();

            $count++;

        }
    }

    public function processEndpoints(){

        $file_name = 'cleaned_endpoints.csv';

        $csv = file_get_contents("$file_name");

        $endpoints = array_map("str_getcsv", explode("\n", $csv));

        $count = 0;

        foreach ($endpoints as $e) {


            $progress = round(100 * ($count / count($endpoints)));

            if ($progress > 0 && $progress < 10) {
                echo "endpoints : [*---------]  $progress% \r";
            } elseif ($progress > 10 && $progress < 20) {
                echo "endpoints : [**--------]  $progress% \r";
            } elseif ($progress > 20 && $progress < 30) {
                echo "endpoints : [***-------]  $progress% \r";
            } elseif ($progress > 30 && $progress < 40) {
                echo "endpoints : [****------]  $progress% \r";
            } elseif ($progress > 40 && $progress < 50) {
                echo "endpoints : [*****-----]  $progress% \r";
            } elseif ($progress > 50 && $progress < 60) {
                echo "endpoints : [******----]  $progress% \r";
            } elseif ($progress > 60 && $progress < 70) {
                echo "endpoints : [*******---]  $progress% \r";
            } elseif ($progress > 70 && $progress < 80) {
                echo "endpoints : [********--]  $progress% \r";
            } elseif ($progress > 80 && $progress < 90) {
                echo "endpoints : [*********-]  $progress% \r";
            } elseif ($progress > 90 && $progress < 100) {
                echo "endpoints : [**********]  $progress% \r";
            }


            if($e[0] === null || $e[10] === "0"){
                $count++;
                continue;
            }

            $endpoint  = new \App\Endpoint();

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

            $model = static::processModel($e[3]);

            $endpoint->endpointmodel($model)->save($model);

            $endpoint->save();

            $location = new \App\Location();

            $location->save();

            $coordinate = new \App\Coordinate();

            $coordinate->save();

            $location->coordinate($coordinate)->save($coordinate);

            $location->save();

            $endpoint->location($location)->save($location);

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

            file_put_contents('x_mrge_endpoints_smrge_endpoints.csv', $endpoint_map.PHP_EOL , FILE_APPEND);



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

    public static function processModel($model_name){
        $model = \App\EndpointModel::getByName($model_name);

        if($model === null){
            return false;
        } else {
            return $model;
        }
    }
}