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
        return array_keys($class->enum);
    }

    static function getValueByKey($key){

        $class = get_called_class();
        dump(strpos($key, 'Enums'));
        dump(strpos($key, 'App'));
        if( strpos($key, 'Enums') || (strpos($key, 'Enum') === 0)){
            $split = explode('Enums\\', $key);
            dump($split);
            $class_key = $split[1];
        } elseif( strpos($key, 'App') || (strpos($key, 'App') === 0)){
            $split = explode('App\\', $key);
            dump($split);
            $class_key = $split[1];
        } else {
            Throw new Exception('The key does not match the current namespace $class : ' . $class , 500);
        }
        try{
            return $class::$enum[$class_key];
        } catch (Exception $e){
            dump($class_key);
            dd($e->getMessage());
        }


    }

    static function getKeyByValue($value){
        $class = get_called_class();
        array_search($value, $class::$enum);
    }
}