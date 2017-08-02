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
    public $endpoint_map_file = 'data_imports/x_mrge_endpoints_smrge_endpoints.csv';
    public $record_file = 'data_imports/records.csv';


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


    public function processRecords() {

        $csv = file_get_contents($this->record_file);

        $records = array_map("str_getcsv", explode("\n", $csv));

        $count = 0;

        $progress_count = 0;

        foreach ($records as $r){

            $progress = round(100 * ($count / count($records)));

            if ($progress >= 0 && $progress < 10) {
                echo "Records : [*---------]  $progress% \r";
            } elseif ($progress >= 10 && $progress < 20) {
                echo "Records : [**--------]  $progress% \r";
            } elseif ($progress >= 20 && $progress < 30) {
                echo "Records : [***-------]  $progress% \r";
            } elseif ($progress >= 30 && $progress < 40) {
                echo "Records : [****------]  $progress% \r";
            } elseif ($progress >= 40 && $progress < 50) {
                echo "Records : [*****-----]  $progress% \r";
            } elseif ($progress >= 50 && $progress < 60) {
                echo "Records : [******----]  $progress% \r";
            } elseif ($progress >= 60 && $progress < 70) {
                echo "Records : [*******---]  $progress% \r";
            } elseif ($progress >= 70 && $progress < 80) {
                echo "Records : [********--]  $progress% \r";
            } elseif ($progress >= 80 && $progress < 90) {
                echo "Records : [*********-]  $progress% \r";
            } elseif ($progress >= 90 && $progress < 100) {
                echo "Records : [**********]  $progress% \r";
            } else {
                if($progress_count === 0) {
                    echo "Records : [**********]  $progress% \n";
                    $progress_count++;
                }
            }
            

            if($r[0] !== null) {

                $end_id = $r[2];

                if ($count === 0 || $r[0] === null || $r[11] === "0000-00-00 00:00:00" || !array_key_exists($end_id, $this->endpoint_map)) {
                    $count++;
                    file_put_contents('data_imports/bad_records.csv', $r[0] . PHP_EOL, FILE_APPEND);
                    continue;
                }

                $record = new \App\Record();


                $dynamic_enum_value = new \App\DynamicEnumValue();

                $dynamic_enum_value->save();

                $dynamic_enum_value->definition(DatabaseSeeder::$dynamic_enum)->save(DatabaseSeeder::$dynamic_enum);

                $dynamic_enum_value->value = $r[0];

                $dynamic_enum_value->value_type = \App\Enums\EnumDataSourceType::getKeyByValue('mrge');

                $dynamic_enum_value->save();

                $record->references($dynamic_enum_value);

                $record->save();


                $endpoint_id = $this->endpoint_map[$end_id];
                $endpoint = \App\Endpoint::getObjectById($endpoint_id);

                $timeperiod = new \App\TimePeriod();
                $timeperiod->start = $r[10];
                $timeperiod->end = $r[11];
                $timeperiod->save();
                $timeperiod->setDuration();

                $remote_number = $r[8];
                $ip2location = \App\Ip2Location::getByIp($remote_number);

                if ($ip2location !== false) {
                    if ($ip2location->latitude !== 0.0 && $ip2location->longitude !== 0.0) {
                        $coordinate = new \App\Coordinate();
                        $coordinate->lng = $ip2location->longitude;
                        $coordinate->lat = $ip2location->latitude;
                        $coordinate->save();

                        $location = new \App\Location();
                        $location->save();

                        $location->address = null;
                        $location->city = $ip2location->city_name;
                        $location->state = $ip2location->region_name;
                        $location->zipcode = $ip2location->zip_code;
                        $location->country_code = $ip2location->country_code;
                        $location->time_zone = $ip2location->time_zone;

                        $location->coordinate($coordinate)->save($coordinate);

                        $location->save();

                        $record->remote_location($location)->save($location);

                    } else {
                        $record->remote_location($endpoint->location)->save($endpoint->location);
                    }
                } else {
                    $record->remote_location($endpoint->location)->save($endpoint->location);
                }

                $record->save();

                $record->timeperiod($timeperiod)->save($timeperiod);
                $record->endpoint($endpoint)->save($endpoint);

                $record->local_id       =   $r[3];
                $record->conference_id  =   $r[4];
                $record->local_name     =   $r[5];
                $record->local_number   =   $r[6];
                $record->remote_name    =   $r[7];
                $record->remote_number  =   $remote_number;
                $record->dialed_digits  =   $r[9];
                $record->direction      =   $r[13];
                $record->protocol       =   $r[14];

                $record->save();

                $record->process();

                $count++;

            } else {
                $count++;
                continue;
            }
        }
    }
}