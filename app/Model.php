<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/5/17
 * Time: 12:45 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{

    protected $guarded = [
        'class_code',
        'mrge_id'
    ];

    public $primaryKey = 'mrge_id';

    public $incrementing = false;

    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent

        $this->class_code = \App\Enums\EnumClassCode::getValueByKey(get_class($this));

        $this->mrge_id = $this->class_code . uniqid();

    }

//
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