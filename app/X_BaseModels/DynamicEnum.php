<?php

namespace App;

use App\Model as Model;

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
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.
        return $this;
    }


    public function setValues($values){
        $this->values = json_encode($values);
        return $this;
    }

    public static function getByName($name){

        return self::where('name','=', $name)->first();

    }

}
