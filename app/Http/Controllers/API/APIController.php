<?php


/**
 * Created by PhpStorm.
 * User: fbreidi
 * Date: 9/26/2017
 * Time: 10:50 AM
 */
namespace App\Http\Controllers\API;
use App\Enums\EnumDataSourceType;
use App\Record;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Helper\Funcs;
use Illuminate\Support\Facades\Log;

 class APIController {

     public function validateRequest($proxy_id, $endpoint_address, $key) {

         $query = "SELECT proxy.*,  endpoint.id as endpoint_id, endpoint.type as endpoint_type, endpoint.ipaddress as endpoint_ipaddress FROM proxy
                 LEFT JOIN endpoint ON endpoint.proxy_id = proxy.id
                 WHERE proxy.id='".$proxy_id."' AND proxy.pkey='".$key."' AND endpoint.ipaddress='".$endpoint_address."' LIMIT 0,1";
         $result = DB::select($query);
        // Log::info($result);

         if($result==false){
             Log::info("couldn't validate request");
             die("couldn't validate request");

         }
        else
            return $result[0];


     }

    public function getRecords(Request $request) {

       // $key = Crypt::decrypt($key);

        $proxy_id = $request->input('proxy_id');
        $endpoint_address = $request->input('endpoint');
        $key = $request->input('key');
        $limit = $request->input('limit', 1);

        $endpoint_proxy_details= $this->validateRequest($proxy_id, $endpoint_address, $key);
         $query = "SELECT record.*, timeperiod.start as join_time, timeperiod.end as leave_time FROM record
        LEFT JOIN endpoint ON record.endpoint_id = endpoint.id
        LEFT JOIN proxy ON endpoint.proxy_id = proxy.id
        LEFT JOIN timeperiod ON timeperiod.id = record.timeperiod_id
        WHERE proxy.id='$proxy_id' AND proxy.pkey='$key'
        ORDER BY record.created_at DESC LIMIT $limit";

        $result = DB::select($query);
       // if(!Funcs::is_multi_array($tmp_res)) $result[] = $tmp_res;
         return json_encode($result);

    }

    public function insertRecords(Request $request) {
        Log::info("insertRecords");

        $proxy_id = $request->input('proxy_id');
        $endpoint_address = $request->input('endpoint');
        $key = $request->input('key');

        $endpoint_proxy_details = $this->validateRequest($proxy_id, $endpoint_address, $key);
        $records = $request->input("records");


        $records = json_decode($records);


        switch ($endpoint_proxy_details->endpoint_type) {
            case EnumDataSourceType::vidyo:
                foreach($records as $record) {

                    $h_record = new \App\Http\Controllers\Helper\Prepare\Record();
                    $h_record->setEndpointId($endpoint_proxy_details->endpoint_id);
                    $h_record->setType(EnumDataSourceType::vidyo);

                    $h_record->setTimeStart($record->JoinTime);
                    $h_record->setTimeEnd($record->LeaveTime);
                    $h_record->setDirection($record->Direction);
                    $h_record->setLocalId($record->CallID);
                    $h_record->setLocalName($record->CallerName);
                    $h_record->setLocalNumber($record->CallerID);
                    $h_record->setRemoteName($record->ConferenceName);
                    $h_record->setRemoteNumber($record->RoomOwner);
                    $h_record->setDialedDigits($record->Extension);
                    /*
                    $h_record->setConferenceId($record->);
                    $h_record->setProtocol($record->);
                    */

                    $h_record->computeAll();

                }
                break;

            case EnumDataSourceType::polycom:

                foreach($records as $record) {

                    $h_record = new \App\Http\Controllers\Helper\Prepare\Record();
                    $h_record->setEndpointId($endpoint_proxy_details->endpoint_id);
                    $h_record->setType(EnumDataSourceType::polycom);

                    $h_record->setTimeStart( date_create_from_format('m-d-Y g:i A', $record->start_date." ".$record->start_time)->format('Y-m-d H:i:s'));
                    $h_record->setTimeEnd(date_create_from_format('m-d-Y g:i A', $record->end_date." ".$record->end_time)->format('Y-m-d H:i:s'));
                    $h_record->setLocalId($record->serial_number);
                    $h_record->setConferenceId($record->serial_number);
                    $h_record->setLocalName($record->name);
                    $h_record->setLocalNumber($record->call_id);
                    $h_record->setRemoteName($record->remote_system_name);
                    $h_record->setRemoteNumber($record->call_number_1);
                    $h_record->setDialedDigits($record->call_number_1);
                    $h_record->setDirection($record->call_direction);
                    $h_record->setProtocol($record->transport_type);

                    $h_record->computeAll();

                }
                    break;

            case EnumDataSourceType::lifesize:


                foreach($records as $record) {


                    $h_record = new \App\Http\Controllers\Helper\Prepare\Record();
                    $h_record->setEndpointId($endpoint_proxy_details->endpoint_id);
                    $h_record->setType(EnumDataSourceType::lifesize);

                    $h_record->setTimeStart($record->start_time);
                   // $h_record->setTimeEnd(date("Y-m-d H:i:s",(strtotime($record->start_time) + strtotime($record->duration)) ));
                    $h_record->setTimeEnd($record->end_time);
                    $h_record->setDirection($record->direction);
                    $h_record->setProtocol($record->protocol);
                    $h_record->setDialedDigits($record->dialed_digits);
                    $h_record->setRemoteNumber($record->remote_number);
                    $h_record->setRemoteName($record->remote_name);
                    $h_record->setLocalName($record->local_name);
                    $h_record->setLocalNumber($record->local_number);
                    $h_record->setConferenceId($record->conference_id);
                    $h_record->setLocalId($record->local_id);
                    $h_record->computeAll();

                }
                break;

        }



    }

    public function grabRecordsFrom($endpoint_id, $from, $to, $key ) {


        $from = html_entity_decode($from);
        $to = html_entity_decode($to);

        $query = "SELECT * FROM record
        LEFT JOIN endpoint ON record.endpoint_id = endpoint.id
        LEFT JOIN proxy ON endpoint.proxy_id = proxy.id
        WHERE endpoint.id='$endpoint_id' AND proxy.key='$key'
        AND record.created_at >= $from
        ORDER BY record.created_at DESC";

        $result = DB::select($query);


        echo json_encode($result);
        die();

    }

     public function grabRecordsFromTo($endpoint_id, $from, $to, $key ) {

         $from = html_entity_decode($from);
         $to = html_entity_decode($to);

         $query = "SELECT * FROM record
        LEFT JOIN endpoint ON record.endpoint_id = endpoint.id
        LEFT JOIN proxy ON endpoint.proxy_id = proxy.id
        WHERE endpoint.id='$endpoint_id' AND proxy.key='$key'
        AND record.created_at >= $from AND record.created_at <= $to
        ORDER BY record.created_at DESC";

         $result = DB::select($query);


         echo json_encode($result);
         die();

     }


}

?>