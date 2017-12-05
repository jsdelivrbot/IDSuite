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
use App\Entity;
use App\Enums\EnumDataSourceType;
use Illuminate\Support\Facades\Input;

class ZabbixController extends Controller
{
    private $user, $password, $jsonrpc, $url, $group_id, $hms_group_id;


    /**
     * ZabbixController constructor.
     */
    public function __construct()
    {

        $this->user = env('ZABBIX_USER');
        $this->password = env('ZABBIX_PASS');
        $this->jsonrpc = env('ZABBIX_JSONRPC');
        $this->url = env('ZABBIX_URL');
        $this->group_id = env('ZABBIX_GROUP_ID');
        $this->hms_group_id = env('ZABBIX_HMS_GROUP_ID');

    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getJsonrpc()
    {
        return $this->jsonrpc;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return mixed
     */
    public function getGroupId()
    {
        return $this->group_id;
    }


    /**
     * @param mixed $group_id
     */
    public function setGroupId($group_id)
    {
        $this->group_id = $group_id;
    }

    private $headers = array(
        'content-type' => 'application/json'
    );

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getDe()
    {
        return $this->de;
    }

    private $version = '3.2';

    public $key = 'zabbix';

    public $de = 'reference_key';


    private function http_post($payload){
        $client = new \GuzzleHttp\Client(['verify' => false]);

        $request = new \GuzzleHttp\Psr7\Request('POST', $this->getUrl(), $this->getHeaders(), $payload);

        $result = json_decode($client->send($request)->getBody()->getContents());

        return $result;
    }

    /**
     *
     */
    private function loginUser(){

        $params = array(
            "user"      => $this->getUser(),
            "password"  => $this->getPassword()
        );

        $payload = json_encode([
            "jsonrpc" => $this->getJsonrpc(),
            "method"=> "user.login",
            "params"=> $params,
            "id"=> 1,
            "auth"=> null
        ]);

        return $this->http_post($payload)->result;
    }


    public function getHistory($item_id, $limit = 1000, $history = 0, $sortfield = "clock", $sortorder = "DESC", $output = "extend"){

        $params = array(
            "output"    => $output,
            "history"   => $history,
            "itemids"   => $item_id,
            "sortfield" => $sortfield,
            "sortorder" => $sortorder,
            "limit"     => $limit
        );

        $payload = json_encode([
            "jsonrpc" => $this->getJsonrpc(),
            "method"=> "history.get",
            "params"=> $params,
            "id"=> 1,
            "auth"=> $this->loginUser()
        ]);

        return $this->http_post($payload)->result;
    }


    public function getHosts($group_id = null, array $host_id_array = null, $sortfield = null, $limit = 10, $sortorder = "DESC", $output = "extend"){

        $output = array("hostid","host","group");

        if($group_id === null){
            $params = array(
                "groupids"  =>  $this->getGroupId(),
                "output"    =>  $output,
            );
        } else {
            $params = array(
                "groupids"  =>  $group_id,
                "output"    =>  $output,
            );
        }


        $payload = json_encode([
            "jsonrpc" => $this->getJsonrpc(),
            "method"=> "host.get",
            "params"=> $params,
            "id"=> 1,
            "auth"=> $this->loginUser()
        ]);

        return $this->http_post($payload)->result;
    }



    public function getHost($host_id, $sortfield = null, $limit = 10, $sortorder = "DESC", $output = "extend"){

        $params = array(
            "output"    =>  "extend",
            "hostids"   =>  $host_id
        );

        $payload = json_encode([
            "jsonrpc" => $this->getJsonrpc(),
            "method"=> "host.get",
            "params"=> $params,
            "id"=> 1,
            "auth"=> $this->loginUser()
        ]);

        return $this->http_post($payload)->result;
    }


    public function getItemsByHost($hostid){

        $search = new \stdClass();

        $search->_key = "icmp";

        $params = array(
            "output"    =>  'extend',
            "hostids"   =>  $hostid,
            "search"    =>  $search,
            "sortfield" =>  "name"
        );

        $payload = json_encode([
            "jsonrpc" => $this->getJsonrpc(),
            "method"=> "item.get",
            "params"=> $params,
            "id"=> 1,
            "auth"=> $this->loginUser()
        ]);

        return $this->http_post($payload)->result;
    }


    public function getRefDe(){
        return DynamicEnum::getByName(ZabbixController::$de);
    }


    public function mapEndpoints(){

        $zendpoints = $this->getHosts(33);
        $count = 0;
        $foundcount = 0;
        $missedcount = 0;

        foreach ($zendpoints as $z){

            $e = Endpoint::getByName($z->host);

            if($e !== null){

                if($e->hasReference($this->key)) {

                    $currentvalue = $e->references()[$this->key];

                    if($currentvalue === $z->hostid){
                        continue;
                    } else {
                        $e->updateDev($this->key, $z->hostid, $this->getRefDe());
                    }
                } else {
                    $dev = new DynamicEnumValue();

                    $dev->value = $z->hostid;
                    $de = DynamicEnum::getByName('reference_key');

                    $dev->value_type = EnumDataSourceType::getKeyByValue($this->key);
                    $dev->definition($de)->save($de);

                    $dev->save();

                    $e->references($dev);

                    $e->save();

                    $foundcount++;

                    echo "found count = $foundcount" . PHP_EOL;

                }

            } else {


                $endpoint = new Endpoint();


                $missedcount++;

                echo "missed count = $missedcount" . PHP_EOL;

            }
            $count++;
        }

    }


    /**
     *
     * mapEntityToHostId
     *
     * maps entity to host id from zabbix
     *
     * @param Entity $entity
     * @return Entity
     */
    public function mapEntityToHostId(Entity $entity)
    {
        $hosts = $this->getHosts($this->hms_group_id);


        foreach($hosts as $host){

            $host_exploded = explode('-', $host->host);

            if($host_exploded[1] === $entity->references()['netsuite']){

                $entity->attachZabbixHostId($host->hostid);

                return $entity;

            } else {
                continue;
            }
        }

    }


    /**
     *
     * getHmsCustomerSummarizedCalculations
     *
     *  return items given zabbix host_id
     *
     * @param $host_id
     * @return array $items
     */
    public function getHmsCustomerSummarizedCalculations($host_id)
    {
       $items = $this->getItemsByHost($host_id);

       return $items;
    }

}