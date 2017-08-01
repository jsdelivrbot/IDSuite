<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 7/22/17
 * Time: 3:49 AM
 */

namespace App\Http\Controllers;


use App\DynamicEnum;
use App\DynamicEnumValue;
use App\Endpoint;
use App\Enums\EnumDataSourceType;
use Illuminate\Support\Facades\Input;

class ZabbixController extends Controller
{
    private static $user, $password, $jsonrpc, $url;

    private static $headers = array(
        'content-type' => 'application/json'
    );

    private static function user(){
        return self::$user = env('ZABBIX_USER');
    }

    private static function password(){
        return self::$password = env('ZABBIX_PASS');
    }

    private static function jsonrpc(){
        return self::$jsonrpc = env('ZABBIX_JSONRPC');
    }
    private static function url(){
        return self::$url = env('ZABBIX_URL');
    }

    private static function headers(){
        return self::$headers;
    }

    private static $version = '3.2';

    public static $key = 'zabbix';

    public static $de = 'reference_key';


    private static function http_post($payload){

        $client = new \GuzzleHttp\Client(['verify' => false]);

        $request = new \GuzzleHttp\Psr7\Request('POST', self::url(), self::headers(), $payload);

        $result = json_decode($client->send($request)->getBody()->getContents());

        return $result;
    }

    /**
     *
     */
    private static function loginUser(){

        $params = array(
            "user"      => self::user(),
            "password"  => self::password()
        );

        $payload = json_encode([
            "jsonrpc" => self::jsonrpc(),
            "method"=> "user.login",
            "params"=> $params,
            "id"=> 1,
            "auth"=> null
        ]);

        return self::http_post($payload)->result;
    }


    public static function getHistory($id, $sortfield = null, $limit = 10, $history = 0, $sortorder = "DESC", $output = "extend"){

        $params = array(
            "output"    => $output,
            "history"   => $history,
            "itemids"   => $id,
            "sortfield" => $sortfield,
            "sortorder" => $sortorder,
            "limit"     => $limit
        );

        $payload = json_encode([
            "jsonrpc" => self::jsonrpc(),
            "method"=> "history.get",
            "params"=> $params,
            "id"=> 1,
            "auth"=> self::loginUser()
        ]);

        return self::http_post($payload)->result;
    }


    public static function getHosts(array $host_id_array = null, $sortfield = null, $limit = 10, $sortorder = "DESC", $output = "extend"){


//        $t=   {
//            "jsonrpc": "2.0",
//            "method": "host.get",
//            "params": {
//                "output": "extend",
//                "filter": {
//                    "host": [
//                        "Zabbix server",
//                        "Linux server"
//                    ]
//                }
//            },
//            "auth": "038e1d7b1735c6a5436ee9eae095879e",
//            "id": 1
//        };



        $output = array("hostid","host","group");


        $params = array(
            "groupids"  =>  "49",
            "output"    =>  $output,
        );

        $payload = json_encode([
            "jsonrpc" => self::jsonrpc(),
            "method"=> "host.get",
            "params"=> $params,
            "id"=> 1,
            "auth"=> self::loginUser()
        ]);

        return self::http_post($payload)->result;
    }



    public static function getHost($host_id = null, $sortfield = null, $limit = 10, $sortorder = "DESC", $output = "extend"){


//        $t=   {
//            "jsonrpc": "2.0",
//            "method": "host.get",
//            "params": {
//                "output": "extend",
//                "filter": {
//                    "host": [
//                        "Zabbix server",
//                        "Linux server"
//                    ]
//                }
//            },
//            "auth": "038e1d7b1735c6a5436ee9eae095879e",
//            "id": 1
//        };



        $params = array(
            "output"    =>  "extend",
            "hostids"   =>  $host_id
        );

        $payload = json_encode([
            "jsonrpc" => self::jsonrpc(),
            "method"=> "host.get",
            "params"=> $params,
            "id"=> 1,
            "auth"=> self::loginUser()
        ]);

        return self::http_post($payload)->result;
    }


    public static function getItemsByHost($hostid){

//          {
//              "jsonrpc": "2.0",
//              "method": "item.get",
//              "params": {
//                  "output": [
//                      "itemid",
//                      "name"
//                  ],
//                  "hostids": "10507",
//                  "search": {
//                      "key_": "icmp"
//                  },
//                  "sortfield": "name"
//              },
//              "auth": "65512ffb085044105e2f1a07851c37ba",
//              "id": 1
//}

        $search = new \stdClass();

        $search->_key = "icmp";

        $output = array(
            "itemid",
            "name",
            "lastvalue"
        );


        $params = array(
            "output"    =>  $output,
            "hostids"   =>  $hostid,
            "search"    =>  $search,
            "sortfield" =>  "name"
        );

        $payload = json_encode([
            "jsonrpc" => self::jsonrpc(),
            "method"=> "item.get",
            "params"=> $params,
            "id"=> 1,
            "auth"=> self::loginUser()
        ]);


        return self::http_post($payload)->result;
    }


    public static function getRefDe(){
        return DynamicEnum::getByName(ZabbixController::$de);
    }


    public static function mapEndpoints(){

        $zendpoints = self::getHosts();
        $count = 0;
        $foundcount = 0;
        $missedcount = 0;

        foreach ($zendpoints as $z){

            $e = Endpoint::getByName($z->host);

            if($e !== null){

                if($e->hasReference(self::$key)) {

                    $currentvalue = $e->references()[self::$key];

                    if($currentvalue === $z->hostid){
                        continue;
                    } else {
                        $e->updateDev(self::$key, $z->hostid, self::getRefDe());
                    }
                } else {
                    $dev = new DynamicEnumValue();

                    $dev->value = $z->hostid;
                    $de = DynamicEnum::getByName('reference_key');

                    $dev->value_type = EnumDataSourceType::getKeyByValue(self::$key);
                    $dev->definition($de)->save($de);

                    $dev->save();

                    $e->references($dev);

                    $e->save();

                    $foundcount++;
                }

            } else {

                $missedcount++;

            }
            $count++;
        }

    }


}