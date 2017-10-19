<?php
/**
 * Created by PhpStorm.
 * User: fbreidi
 * Date: 9/20/2017
 * Time: 11:15 AM
 */

namespace App\Http\Controllers\LifeSize;
use \GuzzleHttp;


class LifeSizeController
{

    private $api_url;
    private $username;
    private $password;

    function __construct($api_url, $username, $password)
    {

        $this->api_url = $api_url;
        $this->username = $username;
        $this->password = $password;
    }

    public function grabCDR()
    {

        // construct query
        $from=null, $to=null;
        if($from !== null)
            $data[]=array('to-date' => $to);
        $data = array('from-date' => $from);
        if($to !== null)
            $data[]=array('to-date' => $to);
        $this->api_url = $this->api_url."?".http_build_query($data);


        $client = new GuzzleHttp\Client();
        $response = $client->request('GET', $this->api_url, ['verify' => false, 'auth' => [$this->username, $this->password] ]);



        return $results;

    }

}