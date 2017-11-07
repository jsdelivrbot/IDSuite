<?php

namespace App;

use App\Model as Model;
use App\Enums\EnumDataSourceType;
use Illuminate\Support\Facades\DB;

/**
 * App\EndpointModel
 *
 * @property string $id
 * @property string $class_code
 * @property string|null $manufacturer
 * @property string|null $manpnumber
 * @property string|null $name
 * @property string|null $description
 * @property float|null $price
 * @property string|null $edition
 * @property int|null $type
 * @property int|null $active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Endpoint[] $endpoints
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndpointModel whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndpointModel whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndpointModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndpointModel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndpointModel whereEdition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndpointModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndpointModel whereManpnumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndpointModel whereManufacturer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndpointModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndpointModel wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndpointModel whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndpointModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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


    /*
     *
     * Relationships
     *
     */
    public function endpoints()
    {
        return $this->hasMany(Endpoint::class, 'model_id', 'id');
    }

    public function references(DynamicEnumValue $dynamic_enum_value = null)
    {

        $references = $this->morphToMany(DynamicEnumValue::class, 'object', 'object_dev')->withTimestamps();

        if ($dynamic_enum_value !== null) {
            $references->attach($dynamic_enum_value, ['dynamic_enum_id' => $dynamic_enum_value->definition->id, 'value_type' => $dynamic_enum_value->value_type]);
        }

        $ref_array = array();

        foreach ($references->get() as $reference) {

            $ref_array[EnumDataSourceType::getValueByKey($reference->value_type)] = $reference->value;
        }

        return $ref_array;
    }


    /**
     *
     * constructor
     *
     * EndpointModel constructor.
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
     * getByMpn
     *
     * @param $mpn
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public static function getByMpn($mpn)
    {
        return EndpointModel::where('manpnumber', $mpn)->first();
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
        return EndpointModel::where('name', $name)->first();
    }

    /**
     *
     * getAllModels
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getAllModels()
    {
        return EndpointModel::all();
    }


}
