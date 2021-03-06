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

    public function getClassTable()
    {

    }

    /**
     *
     * getObjectByRefId
     *
     * Return a single object
     *
     * @param $dynamic_enum_name
     * @param $value_type
     * @param $value
     * @return bool
     * @throws \Exception
     */
    public static function getObjectByRefId($dynamic_enum_name, $value_type, $value)
    {
        $dynamic_enum = DynamicEnum::getByName($dynamic_enum_name);

        $class_path = get_called_class();

        $class = (new $class_path);

        $table_name = $class->table;

        $type = $dynamic_enum->getKeyByValue($value_type);

        $result = $class->select("$table_name.*")->leftjoin('object_dev', "$table_name.id", '=', 'object_dev.object_id')
            ->leftjoin('dynamic_enum_value', 'dynamic_enum_value.id', '=', 'dynamic_enum_value_id')
            ->where('object_dev.value_type', '=', $type)
            ->where('dynamic_enum_value.value', '=', $value)
            ->get();

        if($result->count() > 1){
            throw new \Exception("The value parameter has been found in multiple $class_path(s) class objects that's references relationship has duplicated key -> value DynamicEnumValue objects.", "500");
        } elseif ($result->count() === 1) {
            return $result[0];
        } else {
            return false;
        }
    }


    /**
     *
     * searchByDevType
     *
     * return all of a class type that has a key matching the dynamic enum's values key.
     *
     * @param $value_type
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function searchByDevType($dyanmic_enum_name, $value_type)
    {
        $dyanmic_enum = DynamicEnum::getByName($dyanmic_enum_name);

        $class_path = get_called_class();

        $class = (new $class_path);

        $table_name = $class->table;

        $type = $dyanmic_enum->getKeyByValue($value_type);

        $result = $class->join('object_dev', "$table_name.id", '=', 'object_dev.object_id')
            ->where('value_type', '=', $type)
            ->get();

        return $result;
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
