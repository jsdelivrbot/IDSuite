<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/5/17
 * Time: 12:02 PM
 */

namespace App\Enums;


use Mockery\Exception;

abstract class Enum
{

    static function getKeys(){
        $class = get_called_class();
        $enum_array = $class::$enum;
        return array_keys($enum_array);
    }

    static function getValues(){
        $class = get_called_class();
        $enum_array = $class::$enum;
        return array_values($enum_array);
    }

    static function getClassCode($key){

        $class = get_called_class();

        if( strpos($key, 'Enums') || (strpos($key, 'Enum') === 0)){
            $split = explode('Enums\\', $key);

            $class_key = $split[1];
        } elseif( strpos($key, 'App') || (strpos($key, 'App') === 0)){
            $split = explode('App\\', $key);

            $class_key = $split[1];
        } else {
            Throw new Exception('The key does not match the current namespace $class : ' . $class , 500);
        }
        try{
            return $class::$enum[$class_key];
        } catch (Exception $e){
            dd($e->getMessage());
        }

        return false;

    }

    static function getValueByKey($key){
        $class = get_called_class();


        if(array_key_exists($key, $class::$enum)){
            return $class::$enum[$key];
        } else {
            throw new Exception('The key does not match the current namespace $class : ' . $class , 500);
        }

    }

    static function getKeyByValue($value){
        $class = get_called_class();

        $result = array_search(strtolower($value), array_map('strtolower', $class::$enum));

        if($result || $result === 0){

           return $result;
        } else {
            if($class::$enum[0] === "unknown"){
                return array_search("unknown", $class::$enum);
            } else {
                Throw new Exception('The Value does not match the current namespace $class : ' . $class, 500);
            }
        }
    }
}