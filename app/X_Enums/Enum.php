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

    /**
     *
     * getKeys
     *
     * returns enum keys
     *
     * @return array
     */
    static function getKeys(){
        $class = get_called_class();
        $enum_array = $class::$enum;
        return array_keys($enum_array);
    }

    /**
     *
     * getValues
     *
     * return enum values
     *
     * @return array
     */
    static function getValues(){
        $class = get_called_class();
        $enum_array = $class::$enum;
        return array_values($enum_array);
    }

    /**
     *
     * getClassCode
     *
     * get class code from class path
     *
     * @param $key
     * @return bool
     */
    static function getClassCode($key){

        if($key === null){
            throw new Exception("The key you are attempting get to a get a value with is null");
        }

        $class = get_called_class();

        if( strpos($key, 'Enums') || (strpos($key, 'Enum') === 0)){
            $split = explode('Enums\\', $key);

            $class_key = $split[1];
        } elseif( strpos($key, 'App') || (strpos($key, 'App') === 0)){
            $split = explode('App\\', $key);

            $class_key = $split[1];
        } else {
            $enum = json_encode($class::$enum);
            Throw new Exception("The key $key does not match the current namespace class : $class , $enum" , 500);
        }
        try{
            return $class::$enum[$class_key];
        } catch (Exception $e){
            dd($e->getMessage());
        }

        return false;

    }

    /**
     *
     * getValuesByKey
     *
     * get a value from an enum given a key
     *
     * @param $key
     * @return mixed
     */
    static function getValueByKey($key){

        if($key === null){
            throw new Exception("The key you are attempting to a get a value with is null");
        }

        $class = get_called_class();

        if(array_key_exists($key, $class::$enum)){
            return $class::$enum[$key];
        } else {
            $enum = json_encode($class::$enum);
            throw new Exception("The key $key does not match the current namespace class : $class , $enum" , 500);
        }

    }

    /**
     *
     * getKeyByValue
     *
     *
     *
     * @param $value
     * @return bool|false|int|string
     */
    static function getKeyByValue($value){

        if($value === null){
            throw new Exception("The value you are attempting to get a key with is null");
        }

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