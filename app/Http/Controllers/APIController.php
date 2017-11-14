<?php



namespace App\Http\Controllers;

use App\Enums\EnumDataSourceType;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Netsuite\NetsuiteController;
use App\Record;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Helper\Funcs;
use Illuminate\Support\Facades\Log;

class APIController extends Controller
{

    public static function validateRequest($proxy_id, $endpoint_address, $key)
    {

        $query = "SELECT proxy.*,  endpoint.id AS endpoint_id, endpoint.type AS endpoint_type, endpoint.ipaddress AS endpoint_ipaddress FROM proxy
                 LEFT JOIN endpoint ON endpoint.proxy_id = proxy.id
                 WHERE proxy.id='" . $proxy_id . "' AND proxy.pkey='" . $key . "' AND endpoint.ipaddress='" . $endpoint_address . "' LIMIT 0,1";
        $result = DB::select($query);
      //  Log::info($query);

        if ($result == false) {
            Log::info("couldn't validate request");
            die("couldn't validate request");

        } else
            return $result[0];


    }

    public function getRecords(Request $request)
    {

        // $key = Crypt::decrypt($key);
        dd('in get records');

        $proxy_id = $request->input('proxy_id');
        $endpoint_address = $request->input('endpoint');
        $key = $request->input('key');
        $limit = $request->input('limit', 1);

        $endpoint_proxy_details = $this->validateRequest($proxy_id, $endpoint_address, $key);
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

    /* returns customer netsuite id*/
    public static function searchIdvideophone($search, $type = "tenantname")
    {

        // connect to db do a search and grab netsuite id
        $dbconn = pg_connect("host=".env('IDVIDEOPHONE_HOST')." port=".env('IDVIDEOPHONE_PORT')." dbname=".env('IDVIDEOPHONE_DB')." user=".env('IDVIDEOPHONE_USER')." password=".env('IDVIDEOPHONE_PASSWORD')."");
        $query = "SELECT customerplan.tenantname, customerplan.tenanturl, customerplan.extensionprefix, customerplan.packagetype, customerplan.plantype, netsuiteinfo.netsuiteid, netsuiteinfo.customerid, netsuiteinfo.subscriptionid
                FROM customerplan LEFT JOIN netsuiteinfo ON netsuiteinfo.customerid= customerplan.customerid WHERE customerplan.isactiveplan=1 AND customerplan.activestatus=1 AND
                    $type iLIKE '" . $search . "'HOST
                    ORDER BY customerplan.dateadded LIMIT 1 ";

        $result = pg_query($dbconn, $query);

        if ($result && pg_num_rows($result) > 0) {
//netsuiteid
//
            $row = pg_fetch_assoc($result);


            return $row['netsuiteid'];

        } else return false;

    }

    /* returns customer netsuite id*/
    public static function searchidsflame(\App\Http\Controllers\Helper\Prepare\Record $cdr_log, $netsuite_call = false, $idvideophone_call = false)
    {

        $customer_nsid = array(
            'asu' => 7239,
            'emory' => 7275,
            'idssupport' => 11109, // double check
            'njedge' => 21982,
            'oshean' => 27273,
            'smithsonian' => 7361,
            'uhv' => 10739,
        );

        $tenant_name = $cdr_log->getTenantName();
        $conference_name = $cdr_log->getRemoteName();

        $tenant_name = strtolower(strstr($tenant_name, "-", true) ?: $tenant_name);

        if (isset($customer_nsid[$tenant_name])) {
            return $customer_nsid[$tenant_name]; // looks like we found it in our table

        }

        // is it a gateway?
        if (strtolower($tenant_name) == "gateways") {


            // does it contain idvideophone?
            if (strpos($conference_name, 'idvideophone') !== false) {

                $start_pos = strrpos($conference_name, '@');


                if ($start_pos !== false) {

                    $domain = substr($conference_name, $start_pos + 1, (strlen($conference_name) - $start_pos));
                    $sub_domain = explode('.', $domain)[0];

                    // lookup subdomain in idvideophone

                    $idvideophone_fetch = self::searchIdvideophone($sub_domain);

                    if ($idvideophone_fetch) {
                        return $idvideophone_fetch;
                    }

                }

            }

            // grab first part
            $tenant_name_details = strstr($conference_name, '@', true);

            if (isset($customer_nsid[$tenant_name_details])) {
                return $customer_nsid[$tenant_name_details]; // looks like we found it in our table

            } else {
                $tenant_name = $tenant_name_details;
            }

            // or maybe a substring of gateways
        } elseif (strpos($tenant_name, 'gateways') !== false) {
            $tenant_name = explode(' gateways ', $tenant_name);
            $tenant_name = $tenant_name[0];

            if (isset($customer_nsid[$tenant_name])) {
                return $customer_nsid[$tenant_name];
            }
        }

        // match part of conference name with customer list
        $needle_pos = Funcs::strpos_arr($conference_name, $customer_nsid);
        if ($needle_pos !== false) {
            return $customer_nsid[$needle_pos];

        }



            // let's try idvidephone

        if($idvideophone_call == true) {

            $idvideophone_fetch = self::searchIdvideophone($tenant_name);

            if ($idvideophone_fetch) {
                return $idvideophone_fetch;
            }
        }


// how about a netsuite internal search?

        $query = "SELECT entity.id FROM entity
        LEFT JOIN entitycontact ON entitycontact.id = entity.contact_id
        LEFT JOIN email ON email.id = entitycontact.email_id
        WHERE email.host='" . $tenant_name . "'
        LIMIT 0,1
        ";

        $result = DB::select($query);
        if ($result) {
            $entity_id = $result[0]->id;
            $entity = \App\Entity::getObjectById($entity_id);

            $netsuite_id = $entity->references()['netsuite'];

            if($netsuite_id) return $netsuite_id;
        }


        if($netsuite_call == true) {


        // still here? ok, let's try a netsuite search.
                $ns = new NetsuiteController();
                $ns_result = $ns->searchCustomer($tenant_name, "startsWith");
                $ns_result = $ns_result->recordList->record;
                $customer_details = $ns_result[0];

                if ($customer_details) {
                    return $customer_details->internalId;
                }



                // at this point we are desperate
                if(isset($sub_domain)){

                    $ns = new NetsuiteController();
                    $ns_result = $ns->searchCustomer($sub_domain, "contains");
                    $ns_result = $ns_result->recordList->record;
                    $customer_details = $ns_result[0];

                    if ($customer_details) {
                        return $customer_details->internalId;
                    }
                }

                $ns = new NetsuiteController();
                $ns_result = $ns->searchCustomer($tenant_name, "contains");
                $ns_result = $ns_result->recordList->record;
                $customer_details = $ns_result[0];

                if ($customer_details) {
                    return $customer_details->internalId;
                }

        }

        // we tried our best
        return false;


    }

    public  function insertRecords(Request $request)
    {

        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', "3072M");
        ini_set('upload_max_filesize', "3072M");
        ini_set('post_max_size', "3072M");        Log::info("insertRecords");

        $proxy_id = $request->input('proxy_id');
        $endpoint_address = $request->input('endpoint');
        $key = $request->input('key');

        $endpoint_proxy_details = $this->validateRequest($proxy_id, $endpoint_address, $key);
        $records = $request->input("records");


        $records = json_decode($records);


        switch ($endpoint_proxy_details->endpoint_type) {
            case EnumDataSourceType::vidyo:
                foreach ($records as $record) {


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
                    $h_record->setTenantName($record->TenantName); // not inserted

                    /*
                    $h_record->setConferenceId($record->);
                    $h_record->setProtocol($record->);
                    */

                    $h_record->computeAll();

                }
                break;

            case EnumDataSourceType::polycom:

                foreach ($records as $record) {

                    $h_record = new \App\Http\Controllers\Helper\Prepare\Record();
                    $h_record->setEndpointId($endpoint_proxy_details->endpoint_id);
                    $h_record->setType(EnumDataSourceType::polycom);

                    $h_record->setTimeStart(date_create_from_format('m-d-Y g:i A', $record->start_date . " " . $record->start_time)->format('Y-m-d H:i:s'));
                    $h_record->setTimeEnd(date_create_from_format('m-d-Y g:i A', $record->end_date . " " . $record->end_time)->format('Y-m-d H:i:s'));
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


                foreach ($records as $record) {


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

    public
    static function grabRecordsFrom($endpoint_id, $from, $to, $key)
    {


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

    public
    static function grabRecordsFromTo($endpoint_id, $from, $to, $key)
    {

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