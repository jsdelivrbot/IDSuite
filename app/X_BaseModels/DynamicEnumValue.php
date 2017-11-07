<?php

namespace App;

use App\Model as Model;

/**
 * App\DynamicEnumValue
 *
 * @property string $id
 * @property string $class_code
 * @property int|null $active
 * @property string|null $value
 * @property int|null $value_type
 * @property string|null $dynamicenum_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\DynamicEnum $definition
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DynamicEnumValue whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DynamicEnumValue whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DynamicEnumValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DynamicEnumValue whereDynamicenumId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DynamicEnumValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DynamicEnumValue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DynamicEnumValue whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DynamicEnumValue whereValueType($value)
 * @mixin \Eloquent
 */
class DynamicEnumValue extends Model
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

    protected $table = "dynamic_enum_value";

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
     *  Relationships
     *
     */
    public function definition(DynamicEnum $d = null)
    {
        if ($d !== null) {
            $this->dynamicenum_id = $d->id;
        }
        return $this->hasOne(DynamicEnum::class, 'id', 'dynamicenum_id');
    }

    public function referable($type)
    {
        return $this->morphedByMany($type, 'object', 'object_dev', 'dynamic_enum_value_id', 'object_id')->first();
    }


    /**
     *
     * getByValue
     *
     * @param $ref_id
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public static function getByValue($ref_id)
    {
        $result = (new DynamicEnumValue)->where('value', '=', $ref_id)->first();
        return $result;
    }

    /**
     *
     * getByValueType
     *
     * @param $type
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getByValueType($type)
    {
        $result = (new DynamicEnumValue)->where('value_type', '=', $type)->get();
        return $result;
    }


    /**
     *
     * getByDynamicEnum
     *
     * @param $name
     * @param null $key
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getByDynamicEnum($name, $key = null)
    {
        $de_id = DynamicEnum::getByName($name);

        if ($key !== null) {
            return (new DynamicEnumValue)->where('dynamicenum_id', '=', $de_id->id)->where('value_type', '=', $key)->get();
        } else {
            return (new DynamicEnumValue)->where('dynamicenum_id', '=', $de_id->id)->get();
        }
    }

}
