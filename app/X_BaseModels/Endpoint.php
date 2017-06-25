<?php

namespace App;

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

    ];


    protected $guarded = [
        'password_hash', 'updated_at', 'created_at'
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

        return $this->hasOne(EndpointModel::class);
    }

    public function proxy(Proxy $p = null){

        if($p !== null) {
            $this->proxy_id = $p->id;
        }

        return $this->hasOne(Proxy::class);
    }

    public function location(Location $l = null){

        if($l !== null) {
            $this->location_id = $l->id;
        }

        return $this->hasOne(Location::class);
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
    public function setPassword($password){
        // TODO Password Validation
        try{
            $this->isActive();
            $this->password_hash = Hash::make($password);

            return $this;
        } catch(\Exception $e) {
            dump($e->getMessage());
        }
    }

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
}
