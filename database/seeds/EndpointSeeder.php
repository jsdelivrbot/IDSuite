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

        $this->processEndpoints();



    }


    public function processProxies(){

        dump('start of proxies');

        $file_name = 'endpoint_proxy.csv';

        $csv = file_get_contents($file_name);

        $proxies = array_map("str_getcsv", explode("\n", $csv));

        $count = 0;

        foreach ($proxies as $p) {

            if($count === 0 || $p[0] === null){
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

        }

        dump('end of proxies');

    }


    public function processEndpointModels(){

        dump('start of endpoint models');

        $file_name = 'endpoint_model.csv';

        $csv = file_get_contents("$file_name");

        $models = array_map("str_getcsv", explode("\n", $csv));

        $count = 0;

        foreach ($models as $m){

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

        }

        dump('end of endpoint models');

    }

    public function processEndpoints(){

        dump('start of endpoints');

        $file_name = 'endpoint.csv';

        $csv = file_get_contents("$file_name");

        $endpoints = array_map("str_getcsv", explode("\n", $csv));

        $count = 0;

        foreach ($endpoints as $e) {

            if($count === 0 || $e[0] === null){
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

            $endpoint->status = $e[15];

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

            $count_records_analytic->save();

            $count_records_analytic->endpoint($endpoint)->save($endpoint);

            $count_records_analytic->save();



            $total_call_time_analytic = new \App\Analytic();

            $total_call_time_analytic->save();

            $total_call_time_analytic->analytic_type = \App\Enums\EnumAnalyticType::getKeyByValue('Total');

            $total_call_time_analytic->analytic_object_class = \App\Record::class;

            $total_call_time_analytic->analytic_object_relationship = "timeperiod";

            $total_call_time_analytic->analytic_object_property = "duration";

            $total_call_time_analytic->name = 'Total Call duration';

            $total_call_time_analytic->value = 0;

            $total_call_time_analytic->save();

            $total_call_time_analytic->endpoint($endpoint)->save($endpoint);

            $total_call_time_analytic->save();



            $average_call_time_analytic = new \App\Analytic();

            $average_call_time_analytic->save();

            $average_call_time_analytic->analytic_type = \App\Enums\EnumAnalyticType::getKeyByValue('division');

            $average_call_time_analytic->analytic_object_class = \App\Record::class;

            $average_call_time_analytic->analytic_object_relationship = null;

            $average_call_time_analytic->analytic_object_property = null;

            $average_call_time_analytic->name = 'Average Call duration';

            $average_call_time_analytic->denominator($count_records_analytic)->save($count_records_analytic);

            $average_call_time_analytic->numerator($total_call_time_analytic)->save($total_call_time_analytic);

            $average_call_time_analytic->value = 0;

            $average_call_time_analytic->save();

            $average_call_time_analytic->endpoint($endpoint)->save($endpoint);

            $average_call_time_analytic->save();

        }




        dump('end of endpoints');

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