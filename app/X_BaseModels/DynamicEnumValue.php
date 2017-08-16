<?php

namespace App;

use App\Model as Model;

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


    public function definition(DynamicEnum $d = null){
        if($d !== null) {
            $this->dynamicenum_id = $d->id;
        }
        return $this->hasOne(DynamicEnum::class, 'id', 'dynamicenum_id');
    }

    public function referable($type)
    {
        return $this->morphedByMany($type, 'object', 'x_object_dev', 'dynamic_enum_value_id', 'object_id')->first();
    }

    /**
     *
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        return $this;
    }


    public static function getByValue($ref_id, $type = null) {
        $dev = new DynamicEnumValue;

        if($type == null){
            $result = $dev->where('value', '=', $ref_id)->first();
        }
        else {
            $result = $dev->where('value', '=', $ref_id)->where('value_type', '=', $type)->first();

        }

        return $result;
    }

}
