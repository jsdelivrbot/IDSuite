<?php

namespace App;

use App\Model as Model;
use App\Enums\EnumDataSourceType;

/**
 * App\Proxy
 *
 * @property string $id
 * @property string $class_code
 * @property string|null $entity_id
 * @property string|null $location_id
 * @property string|null $name
 * @property string|null $address
 * @property string|null $port
 * @property string|null $target
 * @property string|null $token
 * @property string|null $pkey
 * @property int|null $active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Endpoint[] $endpoints
 * @property-read \App\Entity $entity
 * @property-read \App\Location $location
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proxy whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proxy whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proxy whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proxy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proxy whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proxy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proxy whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proxy whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proxy wherePkey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proxy wherePort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proxy whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proxy whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proxy whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Proxy extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address', 'name', 'port', 'target', 'token', 'pkey'
    ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "proxy";

    public $incrementing = false;

    protected $keyType = 'uuid';

    /**
     *
     * relationships
     *
     */
    public function entity(Entity $e = null)
    {
        if ($e !== null) {
            $this->entity_id = $e->id;
        }

        return $this->hasOne(Entity::class, 'id', 'entity_id');
    }

    public function location(Location $l = null)
    {
        if ($l !== null) {
            $this->location_id = $l->id;
        }

        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    public function endpoints()
    {
        return $this->hasMany(Endpoint::class, 'proxy_id', 'id');
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
     * constructor.
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
     * getByName
     *
     * @param $name
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public static function getByName($name)
    {
        $proxy = (new Proxy)->where('name', $name)->first();
        return $proxy;
    }

    /**
     *
     * searchByDevType
     *
     * @param $value
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function searchByDevType($value)
    {

        $type = EnumDataSourceType::getKeyByValue($value);

        $result = (new Proxy)->join('object_dev', 'proxy.id', '=', 'object_dev.object_id')
            ->where('value_type', '=', $type)
            ->get();

        return $result;
    }
}
