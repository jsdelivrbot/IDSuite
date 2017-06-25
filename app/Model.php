<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/5/17
 * Time: 12:45 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class Model extends Eloquent
{

    protected $guarded = [
        'class_code',
        'id'
    ];

    public $primaryKey = 'id';

    public $incrementing = false;

    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent

        $this->class_code = \App\Enums\EnumClassCode::getValueByKey(get_class($this));

        $this->id = $this->class_code . uniqid();

        return $this;

    }


    public static function getObjectById($id){

        $class = get_called_class();
        $results = $class::find($id);
        return $results;

    }

    public static function getAllObjects(){
        $class = get_called_class();
        return $class::all();
    }


//    public function __set($property, $value)
//    {
//
//        if(strpos($property, '_id' ) && $property !== 'mrge_id'){
//
//
//
//            $this->$property = $value->mrge_id;
//        } else {
////            echo 'false';
//            $this->$property = $value;
//        }
//    }
//
//    public function __get($property)
//    {
//
//
//
//        if(strpos($property, '_o')){
//
//            $split = explode('_o', $property);
//            $property_id = $split[0] . '_id';
//
//            $class_path = $this->relations[$property];
//
//            dd( $this->$property_id);
//
//            $object = $class_path::find($this->$property_id);
//
//            dd($object);
//
//            return $object;
//
//        } else {
//            return $this->$property;
//        }
//    }



}