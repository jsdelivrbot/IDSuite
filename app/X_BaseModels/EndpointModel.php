<?php

namespace App;

use App\Model as Model;
use App\Enums\EnumDataSourceType;
use Illuminate\Support\Facades\DB;

class EndpointModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'manufacturer', 'name', 'architecture', 'key'
    ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "endpointmodel";

    public $incrementing = false;

    protected $keyType = 'uuid';

    public function endpoints(){
        return $this->hasMany(Endpoint::class, 'model_id', 'id');
    }

    public function references(DynamicEnumValue $dynamic_enum_value = null){

        $references = $this->morphToMany(DynamicEnumValue::class, 'object','x_object_dev');

        if($dynamic_enum_value !== null) {
            $references->attach($dynamic_enum_value, ['dynamic_enum_id' => $dynamic_enum_value->definition->id]);
        }

        $ref_array = array();

        foreach($references->get() as $reference){

            $ref_array[EnumDataSourceType::getValueByKey($reference->value_type)] = $reference->value;
        }

        return $ref_array;
    }

    /**
     * EndpointModel constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.


        return $this;

    }

    public static function getByMpn($mpn){
        $model = EndpointModel::where('manpnumber', $mpn)->first();

        return $model;
    }

    public static function getByName($name){

        $model = EndpointModel::where('name', $name)->first();

        return $model;
    }

    public static function getAllModels(){
        return $models = EndpointModel::all();
    }


}
