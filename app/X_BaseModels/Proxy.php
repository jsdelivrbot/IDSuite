<?php

namespace App;

use App\Model as Model;

class Proxy extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address', 'name', 'port', 'target', 'token', 'key'
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
     * relationships
     */
    public function entity(Entity $e = null){
        if($e !== null){
            $this->entity_id = $e->id;
        }

        return $this->hasOne(Entity::class, 'id', 'entity_id');
    }

    public function location(Location $l = null){
        if($l !== null){
            $this->location_id = $l->id;
        }

        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    public function endpoints(){
        return $this->hasMany(Endpoint::class, 'proxy_id', 'id');
    }


    /**
     * User constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        return $this;

    }

    public static function getByName($name){
        $proxy = Proxy::where('name', $name)->first();

        return $proxy;
    }
}
