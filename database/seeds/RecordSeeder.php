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

            $timeperiod = new \App\TimePeriod();
            $timeperiod->start = $r[10];
            $timeperiod->end = $r[11];
            $timeperiod->save();
            $timeperiod->setDuration();

            $record = new \App\Record();

            $record->save();

            $record->timeperiod($timeperiod)->save($timeperiod);

            $record->endpoint($endpoint)->save($endpoint);

            $record->local_id =$r[3];
            $record->conference_id =$r[4];
            $record->local_name =$r[5];
            $record->local_number =$r[6];
            $record->remote_name =$r[7];
            $record->remote_number =$r[8];
            $record->dialed_digits =$r[9];
            $record->direction =$r[13];
            $record->protocol =$r[14];

            $record->save();

        }

    }


}