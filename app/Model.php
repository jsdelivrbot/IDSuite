<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/5/17
 * Time: 12:45 AM
 */

namespace App;

use App\Enums\EnumDataSourceType;
use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class Model extends Eloquent
{

    protected $guarded = [
        'class_code',
        'active',
        'id'
    ];

    public $primaryKey = 'id';

    public $incrementing = false;

    public function __construct($attributes = array())
    {
        parent::__construct($attributes); // Eloquent

        $this->class_code = \App\Enums\EnumClassCode::getClassCode(get_class($this));

        $this->id = $this->class_code . uniqid();

        $this->active = 1;

        return $this;

    }


    /**
     * @param $id
     * @return $class::class
     */
    public static function getObjectById($id)
    {
        $class = get_called_class();
        $results = $class::find($id);
        return $results;

    }




    /**
     * Returns whether or not this use is active.
     * @return bool
     * @internal param $id
     */
    public function isActive()
    {
        if ($this->active) {
            return true;
        } else {
            Throw new Exception('This Object is not active.', 409);
        }
    }


    public function getReference($type_value){

        if(in_array($type_value, EnumDataSourceType::$enum))
        {
            return $this->references[EnumDataSourceType::getKeyByValue($type_value)];
        } else {
            $notfound = new \stdClass();
            $notfound->value = null;
            return $notfound;
        }

    }


    public function getObject($depth = 2)
    {
        $result = $this;

        for($i=0; $i<$depth; $i++) {
            $result = $this::getObjectFirst($result, $depth-1);
        }

        return $result;


    }

    private function getObjectFirst($this_object, $level)
    {

      //  echo "in level ".$level;
       // dump($this_object);

        if(!property_exists ($this_object, 'relationships' ))
            return $this_object;

        $relationships = array_values($this_object->relationships);
        $attributes = array_keys($this_object->getAttributes());
        $property_keys = array_merge($attributes, $relationships);

        $object = new \stdClass();
        foreach ($property_keys as $property_key) {


            if($level != 0 && in_array($property_key, $this_object->relationships) && $this_object->$property_key != null) { //&& property_exists($object, $property_key)

              //  echo "recursive for ".$property_key."...\n";

                $sub_object = $this->getObjectFirst($this_object->$property_key, $level-1);
            //    echo "sub object";
             //   dump($sub_object);
                $object->$property_key = $sub_object;
            }else {
                $object->$property_key = $this_object->$property_key;
            }


        }

        return $object;

    }


}
