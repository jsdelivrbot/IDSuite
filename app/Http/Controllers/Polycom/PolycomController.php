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


    private $api_url, $username, $password;

    function __construct($api_url, $username, $password)
    {
        $this->api_url = $api_url;
        $this->username = $username;
        $this->password = $password;
    }


    public function grabCDR($from= "2000-09-11", $to=null) {
        $cdr_rows = []; // to be filled

        $data = array('from-date' => $from);
        if($to !== null)
            $data[]=array('to-date' => $to);
        $this->api_url = $this->api_url."?".http_build_query($data);


        $tmp_file_path = tempnam(sys_get_temp_dir(), "polycom");

        $client = new GuzzleHttp\Client();

        $response = $client->request('GET', $this->api_url, ['verify' => false, 'auth' => [$this->username, $this->password] ]);



        $status_code = $response->getStatusCode(); // hopefully 200
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
                $cdr_row = [];

                $cdr_line= str_getcsv($line);

                if(is_array($cdr_line) && count($cdr_line) >=27) {
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

                    $cdr_rows[]= $cdr_row;

                }

            }


        }
        return $cdr_rows;

    }
}