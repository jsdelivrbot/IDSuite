<?php
/**
 * Created by PhpStorm.
 * User: fbreidi
 * Date: 9/14/2017
 * Time: 2:38 PM
 */

namespace App\Http\Controllers\Vidyo;


use Illuminate\Support\Facades\DB;
class VidyoController
{


    private $host;
    private $username;
    private $password;
    private $database;
    private $port;

    function __construct($host, $username, $password, $database, $port= '3306')
    {

        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->port = $port;
    }


    public function grabCDR($from= "2000-09-11", $to=null)
    {

        $to = ($to ===null) ? "" : " AND LeaveTime < '$to''";

        // direct mysql connection
        \Config::set('database.connections.vidyo_tmp', array(
            'driver'    => 'mysql',
            'host'      => $this->host,
            'database'  => 'portal2',
            'username'  => $this->username,
            'password'  => $this->password,
            'port'      => $this->port,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ));


        $connection = DB::connection('vidyo_tmp');

        // grab latest from to date
                $result = $connection->select("SELECT * from ConferenceCall2 WHERE
        CallState = 'COMPLETED' AND
        
        JoinTime > '$from' $to order by CallID DESC limit 1000");


        /* No need to parse, looks good already, example output
        {
            +"CallID": 216844
            +"UniqueCallID": "5748541991803003"
            +"ConferenceName": "DEOWENS@emory.idsflame.com"
            +"TenantName": "gateways"
            +"ConferenceType": "C"
            +"EndpointType": "L"
            +"CallerID": ""
            +"CallerName": "anonymous"
            +"JoinTime": "2017-09-20 11:07:04"
            +"LeaveTime": "2017-09-20 11:07:35"
            +"CallState": "COMPLETED"
            +"Direction": "I"
            +"RouterID": "4YP6W11YJKPDRPT3EZJGSGP4MEPPM44182DNPBHDVBGQZ00VR0001"
            +"GWID": "1djuucIFcRAt3yXTjQQp"
            +"GWPrefix": "IVRDEFAULTC"
            +"ReferenceNumber": ""
            +"ApplicationName": "VidyoGateway"
            +"ApplicationVersion": ""
            +"ApplicationOs": ""
            +"DeviceModel": "Vox Callcontrol"
            +"EndpointPublicIPAddress": "81.201.82.176"
            +"AccessType": "L"
            +"RoomType": "M"
            +"RoomOwner": "DEOWENS"
            +"CallCompletionCode": "1"
            +"Extension": null
            +"EndpointGUID": "7f47bbc5-b06f-4e1a-b767-e773eaa37095"
        }
        */

        return $result;


    }



}