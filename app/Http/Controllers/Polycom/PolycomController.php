<?php
/**
 * Created by PhpStorm.
 * User: fbreidi
 * Date: 9/8/2017
 * Time: 11:35 AM
 */

namespace App\Http\Controllers\Polycom;
use \GuzzleHttp;


class PolycomController
{
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





    public static function grabCDR($from= "2000-09-11", $to=null) {
        $api_url = "https://10.0.14.87:8443/api/rest/billing";

        $data = array('from-date' => $from);
        if($to !== null)
            $data[]=array('to-date' => $to);
        $api_url = $api_url."?".http_build_query($data);


        $tmp_file_path = tempnam(sys_get_temp_dir(), "polycom");

        $client = new GuzzleHttp\Client();

        $response = $client->request('GET', $api_url, ['verify' => false, 'auth' => ['IDS\fbreidi', 'openinternet'] ]);



        $status_code = $response->getStatusCode(); // 200
        file_put_contents ($tmp_file_path , $response->getBody()->getContents());


        $zipper = new \Chumper\Zipper\Zipper();

        $files_arr = $zipper->make($tmp_file_path)->listFiles();

        foreach ($files_arr as $file) {
            if(strpos($file, "CONFLIST_DETAIL_ALL_CSV") !== false) {
                $conflist_detail_all_csv = $zipper->getFileContent($file);
            }

            if(strpos($file, "ENDPOINT_CDR_DETAIL_ALL_CSV") !== false) {
                $endpoint_cdr_detail_all_csv = $zipper->getFileContent($file);
            }

       }

        $lines = explode("\n", $endpoint_cdr_detail_all_csv);
        foreach ($lines as $index => $line) {
            if($index !=0) {
                // skip first line

                $cdr_line= str_getcsv($line);

                // insert into database START

                $cdr_row['name'] =  $cdr_line[0]; // ClareyMcKayRP-Desktop
                $cdr_row['serial_number'] = $cdr_line[1]; //uuid or some string id

                $cdr_row['start_date'] = $cdr_line[2]; //mm-dd-YYYY
                $cdr_row['start_time'] = $cdr_line[3]; //1:25 PM
                $cdr_row['end_date'] = $cdr_line[4];
                $cdr_row['end_time'] = $cdr_line[5];
                $cdr_row['call_duration'] = $cdr_line[6]; //00:02:43
                // account number always missing
                $cdr_row['remote_system_name'] = $cdr_line[8]; // long string
                $cdr_row['call_number_1'] = $cdr_line[9];
                $cdr_row['transport_type'] = $cdr_line[11]; // SIP H_323
                $cdr_row['call_rate'] = $cdr_line[12]; // number
                $cdr_row['call_direction'] = $cdr_line[14]; // OUTGOING INCOMING
                $cdr_row['call_id'] = $cdr_line[16]; // number
                $cdr_row['endpoint_transport_address'] = $cdr_line[21]; // email or id or username@host or ip
                $cdr_row['audio_protocol_tx'] = $cdr_line[22];
                $cdr_row['audio_protocol_rx'] = $cdr_line[23];
                $cdr_row['video_protocol_tx'] = $cdr_line[24];
                $cdr_row['video_protocol_rx'] = $cdr_line[25];
                $cdr_row['video_format_tx'] = $cdr_line[26]; // resolution
                $cdr_row['video_format_rx'] = $cdr_line[27]; // resolution

                dd($cdr_row);

                row_id,"row_stamp",endpoint_id,local_id,conf_id,"local_name","local_number","remote_name","remote_number","dialed_digits","start_time","end_time","duration","direction","protocol"
53308,"2017-07-10 16:00:33",172,120,0,"Cummins - India Dewas CTT 1st Floor Daffodil","10.187.254.18","APAC Virtual Meeting Room 1","718101","718101","2017-07-07 10:34:02","0000-00-00 00:00:00","02:27:06","Out","h323"
53309,"2017-07-10 16:00:33",172,121,0,"Cummins - India Dewas CTT 1st Floor Daffodil","10.187.254.18","India Pune IOC 6th Floor Rm A-627","3020","3020","2017-07-07 10:36:25","0000-00-00 00:00:00","00:01:34","In","voice_h323"
                
                
                
                $record = new \App\Record();
                $dynamic_enum_value = new \App\DynamicEnumValue();
                $dynamic_enum_value->save();
                $dynamic_enum_value->definition(DatabaseSeeder::$dynamic_enum)->save(DatabaseSeeder::$dynamic_enum);
                $dynamic_enum_value->value = $cdr_row[0];
                $dynamic_enum_value->value_type = \App\Enums\EnumDataSourceType::getKeyByValue('mrge');

                $dynamic_enum_value->save();

                $record->references($dynamic_enum_value);

                $record->save();
                

                $endpoint_id = $this->endpoint_map[$end_id];
                $endpoint = \App\Endpoint::getObjectById($endpoint_id);

                $timeperiod = new \App\TimePeriod();
                $timeperiod->start = date_create_from_format('m-d-Y g:i A', $cdr_row['start_date']." ".$cdr_row['start_time'])->format('Y-m-d H:i:s');
                $timeperiod->end = date_create_from_format('m-d-Y g:i A', $cdr_row['end_date']." ".$cdr_row['end_time'])->format('Y-m-d H:i:s');
                $timeperiod->save();
                $timeperiod->setDuration();

                $ip2location = \App\Ip2Location::getByIp($remote_number);
                if ($ip2location !== false && $ip2location->latitude !== 0.0 && $ip2location->longitude !== 0.0) {
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

                $record->save();

                $record->timeperiod($timeperiod)->save($timeperiod);
                $record->endpoint($endpoint)->save($endpoint);

                // check and validate with amac
                $record->local_id       =   $cdr_row['serial_number'];
                $record->conference_id  =   $cdr_row['serial_number'];
                $record->local_name     =   $cdr_row['name'];
                $record->local_number   =   $cdr_row['call_id'];
                $record->remote_name    =   $cdr_row['remote_system_name'];
                $record->remote_number  =   $cdr_row['call_number_1'];
                $record->dialed_digits  =   $cdr_row['call_number_1'];
                $record->direction      =   (strtolower($cdr_row['call_direction'])=="incoming" ? "in" : "out");
                $record->protocol       =  $cdr_row['transport_type'];

                $record->save();

                $record->process();

                // insert into database END

            }


        }

    }
}