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

    public function referable()
    {
        return $this->morphTo();
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

}
