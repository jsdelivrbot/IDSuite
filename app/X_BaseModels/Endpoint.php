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
        'customer', 'manufacturer', 'model', 'username', 'name', 'ipaddress', 'macaddress', 'proxy', 'sync_time', 'reboot_time', 'last_reboot', 'status', 'model_type', 'status_at'
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

    /**
     * relationships
     */
    public function customer(){
        return $this->hasOne('App\Customer', 'mrge_id', 'customer_id');
    }

    public function model(){
        return $this->hasOne('App\EndpointModel', 'mrge_id', 'model_id');
    }

    public function proxy(){
        return $this->hasOne('App\Proxy', 'mrge_id', 'proxy_id');
    }


    /**
     * Endpoint constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        $this->active = 1;

        $this->save();

        return $this;

    }


    /**
     * @param $password string
     * set user password_hash
     */
    public function setPassword($password){
        // TODO Password Validation
        try{
            $this->isActive();
            $this->password_hash = Hash::make($password);
            if($this->exists) {
                $this->save();
            }
        } catch(\Exception $e) {
            dump($e->getMessage());
        }
    }
}
