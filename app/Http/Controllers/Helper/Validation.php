<?php
/**
 * Created by PhpStorm.
 * User: fbreidi
 * Date: 8/8/2017
 * Time: 11:49 AM
 */

namespace App\Http\Controllers\Helper;


class Validation
{

    public static function isEmailValid($email, $validate_host = false, $false_return=false) {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            if($validate_host) {
                $domain = ltrim(stristr($email, '@'), '@');
                if (!checkdnsrr($domain, 'MX')) {
                    return $false_return;
                }
            }
        } else {
            return $false_return;
        }

        return true;
    }


    public static function isDomainValid($domain_name, $validate_host = false , $false_return=false) {

         if(!preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name) //valid chars check
            && preg_match("/^.{1,253}$/", $domain_name) //overall length check
            && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name)   )
             return $false_return;


         if($validate_host) {
            if(filter_var(gethostbyname($domain_name), FILTER_VALIDATE_IP))
            {
                return true;
            }else{
                return  $false_return;
            }

         }
         return true;
    }


    public static function isUrlValid($url,  $validate_host = false , $false_return=false) {

        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE)
            return $false_return;
        else{


            if($validate_host) {
                $url = parse_url($url);
                if(!(gethostbyname($url["host"]) == $url["host"]))
                    return $false_return;
            }

        }
            return true;
    }


    public static function isPhoneValid($phone, $false_return=false) {

        $phone = preg_replace('/\D+/', '', $phone);

        if(strlen($phone)> 15) return $false_return;


        if( ! ctype_digit(strval($phone)) ){
            return $false_return;
        }

        return true;

    }




}