<?php

namespace App;

use App\Enums\EnumDataSourceType;
use Illuminate\Support\Facades\Hash;

use App\Model as Model;

class Endpoint extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'entity_id', 'proxy_id', 'location_id', 'type','e_many', 'ipaddress'
    ];


    protected $guarded = [
        'updated_at', 'created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'active'
    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "endpoint";

    public $incrementing = false;

    protected $keyType = 'uuid';
    /**
     * relationships
     */

    public function endpointmodel(EndpointModel $e = null){

        if($e !== null) {
            $this->model_id = $e->id;
        }

        return $this->hasOne(EndpointModel::class, 'id', 'model_id');
    }

    public function proxy(Proxy $p = null){

        if($p !== null) {
            $this->proxy_id = $p->id;
        }

        return $this->hasOne(Proxy::class, 'id', 'proxy_id');
    }

    public function location(Location $l = null){
        if($l !== null){
            $this->location_id = $l->id;
        }

        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    public function entity(Entity $e = null){

        if($e !== null) {
            $this->entity_id = $e->id;
        }

        return $this->hasOne(Entity::class, 'id', 'entity_id');
    }

    public function records(){
        return $this->hasMany(Record::class, 'endpoint_id', 'id');
    }

    public function analytics(){
        return $this->hasMany(Analytic::class, 'endpoint_id', 'id');
    }

    public function references(DynamicEnumValue $dynamic_enum_value = null){

        $references = $this->morphToMany(DynamicEnumValue::class, 'object','object_dev')->withTimestamps();

        if($dynamic_enum_value !== null) {
            $references->attach($dynamic_enum_value, ['dynamic_enum_id' => $dynamic_enum_value->definition->id, 'value_type' => $dynamic_enum_value->value_type]);
        }

        $ref_array = array();

        foreach($references->get() as $reference){

            $ref_array[EnumDataSourceType::getValueByKey($reference->value_type)] = $reference->value;
        }

        return $ref_array;
    }


    public function devs(DynamicEnumValue $dynamic_enum_value = null, $getAllDev = false){
        return $this->morphToMany(DynamicEnumValue::class, 'object','object_dev')->withTimestamps();
    }

    /**
     * Endpoint constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        $this->active = 1;

        return $this;

    }


    /**
     * @param $password string
     * set user password_hash
     * @return $this
     */

    /*
    public function setPassword($password){
        // TODO Password Validation
        try{
            $this->isActive();
            $this->password = encrypt($password);

            $this->save();
        } catch(\Exception $e) {
            dump($e->getMessage());
        }
        return $this;
    }
    public function getPassword($encrypted_password){
        // TODO Password Validation
        try{
            $this->isActive();
            $this->password = decrypt($encrypted_password);

        } catch(\Exception $e) {
            dump($e->getMessage());
        }
        return $this->password;
    }

    */

    /**
     * @return bool
     *
     * is Active
     * returns whether or not the user is active.
     */
    public function isActive(){
        if($this->active) {
            return true;
        } else {
            Throw new Exception('This user is not active. Therefore you cannot change the password', 409);
        }
    }


    public static function getByName($name){
        return Endpoint::where('name', $name)->first();
    }

    public static function getByCol($col, $value){
        return self::where($col, $value)->first();
    }

    public function hasReference($reference_key){
        $result = array_key_exists($reference_key, $this->references());
        return $result;
    }

    public function updateDev($key, $value, $de){

        if($this->hasReference($key)){
            foreach($this->devs as $dev){
                if ($dev->dynamicenum_id === $de->id){
                    if($de->values[$dev->value_type] === $key){
                        if($dev->value === $value){
                            return $dev;
                        } else {
                            $dev->value = $value;
                            $dev->save();
                            return $dev;
                        }
                    } else {
                        continue;
                    }
                }
            }
        }

        return false;

    }



}
