<?php

namespace App;

use App\Model as Model;

/**
 * App\DynamicEnum
 *
 * @property string $id
 * @property string $class_code
 * @property int|null $active
 * @property array $values
 * @property string|null $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DynamicEnum whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DynamicEnum whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DynamicEnum whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DynamicEnum whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DynamicEnum whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DynamicEnum whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DynamicEnum whereValues($value)
 * @mixin \Eloquent
 */
class DynamicEnum extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    protected $casts = [
        'values' => 'array'
    ];

    protected $table = "dynamic_enum";

    public $incrementing = false;

    protected $keyType = 'uuid';


    /**
     *
     * constructor
     *
     * @param array $attributes
     */
    public function __construct($attributes = array())
    {
        parent::__construct($attributes); // Eloquent
        // Your construct code.
        return $this;
    }


    /**
     *
     * setValues()
     *
     * @param $values
     * @return $this
     */
    public function setValues($values)
    {
        $this->values = json_encode($values);
        return $this;
    }

    /**
     *
     * getValues()
     *
     * get json encoded values and decode.
     *
     * @return array
     */
    public function getValues()
    {
        return json_decode($this->values, true);
    }


    /**
     *
     * getKeys
     *
     * get keys.
     *
     * @return array
     */
    public function getKeys()
    {
        return array_keys($this->getValues());
    }

    /**
     *
     * getByName
     *
     * @param $name
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public static function getByName($name)
    {

        return (new DynamicEnum)->where('name', '=', $name)->first();

    }

    /**
     *
     * getKeyByValue
     *
     * returns key give a value.
     *
     * @param $value
     * @return false|int|string
     * @throws \Exception
     */
    public function getKeyByValue($value)
    {
        $key = array_search($value, $this->getValues());

        if ($key === false) {
            throw new \Exception('The value "' . $value . '" is not a value in this Dynamic Enum "' . $this->id . '". The values are ' . print_r($this->getValues(), true), 500);
        } else {
            return $key;
        }
    }


    /**
     *
     * getValueByKey
     *
     * get value by key
     *
     * @param $key
     * @return mixed
     * @throws \Exception
     */
    public function getValueByKey($key)
    {
        $exist = array_key_exists($key, $this->getValues());

        if(!$exist){
            throw new \Exception('The key "' . $key . '" is not a key in this Dynamic Enum "' . $this->id . '". The keys are ' . print_r($this->getKeys(), true), 500);
        } else {
            return $this->getValues()[$key];
        }
    }

}
