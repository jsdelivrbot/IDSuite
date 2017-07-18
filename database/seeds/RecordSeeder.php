<?php
use Illuminate\Database\Seeder;
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/30/17
 * Time: 12:20 PM
 */
class RecordSeeder extends Seeder
{

    // files //
    public $endpoint_map_file = 'x_mrge_endpoints_smrge_endpoints.csv';
    public $record_file = 'records.csv';


    public $endpoint_map;

    public function run(){
        $this->getEndpointMap();

        $this->processRecords();
    }

    public function getEndpointMap(){
        $map = file($this->endpoint_map_file);

        $endpointmap = array();

        foreach ($map as $line){
            $line = str_getcsv($line);
            $endpointmap[$line[0]] = trim($line[1]);
        }

        $this->endpoint_map = $endpointmap;
    }


    public function processRecords(){

        $csv = file_get_contents($this->record_file);

        $records = array_map("str_getcsv", explode("\n", $csv));

        $count = 0;

        foreach ($records as $r){

            $progress = round(100 * ($count / count($records)));

            if ($progress > 0 && $progress < 10) {
                echo "records : [*---------]  $progress% \r";
            } elseif ($progress > 10 && $progress < 20) {
                echo "records : [**--------]  $progress% \r";
            } elseif ($progress > 20 && $progress < 30) {
                echo "records : [***-------]  $progress% \r";
            } elseif ($progress > 30 && $progress < 40) {
                echo "records : [****------]  $progress% \r";
            } elseif ($progress > 40 && $progress < 50) {
                echo "records : [*****-----]  $progress% \r";
            } elseif ($progress > 50 && $progress < 60) {
                echo "records : [******----]  $progress% \r";
            } elseif ($progress > 60 && $progress < 70) {
                echo "records : [*******---]  $progress% \r";
            } elseif ($progress > 70 && $progress < 80) {
                echo "records : [********--]  $progress% \r";
            } elseif ($progress > 80 && $progress < 90) {
                echo "records : [*********-]  $progress% \r";
            } elseif ($progress > 90 && $progress < 100) {
                echo "records : [**********]  $progress% \r";
            }


            if($count === 0 || $r[0] === null){
                $count++;
                continue;
            }

            $end_id = $r[2];

            if(array_key_exists($end_id, $this->endpoint_map)){
                $endpoint_id = $this->endpoint_map[$end_id];
                $endpoint = \App\Endpoint::getObjectById($endpoint_id);
            } else {

                file_put_contents('bad_records.csv', $r[0].PHP_EOL , FILE_APPEND);

                continue;
            }
            $remote_number = $r[8];

            $timeperiod = new \App\TimePeriod();
            $timeperiod->start = $r[10];
            $timeperiod->end = $r[11];
            $timeperiod->save();
            $timeperiod->setDuration();


            $ip2location = \App\Ip2Location::getByIp($remote_number);


            $coordinate = new \App\Coordinate();
            $coordinate->lng = $ip2location->longitude;
            $coordinate->lat = $ip2location->latitude;
            $coordinate->save();


            $location = new \App\Location();
            $location->address = null;
            $location->city =$ip2location->city;
            $location->state =$ip2location->state;
            $location->zipcode =$ip2location->zipcode;
            $location->country_code = $ip2location->country_code;
            $location->time_zone = $ip2location->time_zone;
            $location->coordinate($coordinate)->save($coordinate);
            $location->save();


            $record = new \App\Record();

            $record->save();


            $record->timeperiod($timeperiod)->save($timeperiod);
            $record->remote_location($location)->save($location);
            $record->endpoint($endpoint)->save($endpoint);

            $record->local_id =$r[3];
            $record->conference_id =$r[4];
            $record->local_name =$r[5];
            $record->local_number =$r[6];
            $record->remote_name =$r[7];
            $record->remote_number =$remote_number;
            $record->dialed_digits =$r[9];
            $record->direction =$r[13];
            $record->protocol =$r[14];

            $record->save();

            $record->process();

//            $avc = new \App\AnalyticValueCache();
//            $avc->name = 'total';
//            $avc->value = 1

            $count++;


        }

    }


}