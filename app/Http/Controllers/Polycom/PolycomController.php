<?php
/**
 * Created by PhpStorm.
 * User: fbreidi
 * Date: 9/8/2017
 * Time: 11:35 AM
 */

namespace App\Http\Controllers;
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
    




    function grabCDR($from= "2000-09-11", $to=null) {
        $api_url = "https://10.0.14.87:8443/api/rest/billing";

        $data = array('from-date' => $from);
        if($to !== null)
            $data[]=array('to-date' => $to);


        $tmp_file = tempnam(sys_get_temp_dir(), "polycom");

        $client = new GuzzleHttp\Client();
        $res = $client->get($api_url )->setResponseBody($tmp_file)->send();


        $status_code = $res->getStatusCode(); // 200
        $body = $res->getBody();

        dump("status code:", $status_code);
        dd($body);



    }
}