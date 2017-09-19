<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 9/19/17
 * Time: 1:33 PM
 */

namespace App\Http\Controllers;


class VidyoController extends Controller
{

    private $app_id, $app_key, $app_token;


    public function __construct()  {
        $this->app_id = env("VIDYO_APP_ID");
        $this->app_key = env("VIDYO_DEV_KEY");
        $this->app_token = env("VIDYO_TOKEN");

        return $this;
    }


    public function getToken(){
        return $this->app_token;
    }

    public function getAppId(){
        return $this->app_id;
    }

}