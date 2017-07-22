<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 7/22/17
 * Time: 3:49 AM
 */

namespace App\Http\Controllers;


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


    private static function http_post($payload){

        $client = new \GuzzleHttp\Client(['verify' => false]);

        $request = new \GuzzleHttp\Psr7\Request('POST', self::url(), self::headers(), $payload);

        $result = json_decode($client->send($request)->getBody()->getContents());

        return $result;

    }

    /**
     *
     */
    public static function loginUser(){

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


    public static function getHistory($id, $sortfield, $limit = 10, $history = 0, $sortorder = "DESC", $output = "extend"){

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
}