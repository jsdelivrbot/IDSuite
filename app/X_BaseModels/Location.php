<?php

namespace App;

use App\Coordinate;
use App\Model as Model;

class Location extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coordinates', 'address', 'city', 'state', 'zipcode'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "location";

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $guarded = [
        'class_code'
    ];

    /**
     * relationships
     */
    public function coordinate(){
        return $this->hasOne('App\Coordinate', 'mrge_id', 'coordinate_id');
    }


    /**
     * User constructor.
     * @param Coordinate|array $coordinates
     * @param $address
     * @param $city
     * @param $state
     * @param $zipcode
     * @param array $attributes
     * @internal param string $firstname
     * @internal param string $lastname
     * @internal param string $email
     * @internal param string $password
     */
    public function __construct(Coordinate $coordinates = null, $address, $city, $state, $zipcode, $attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.



        if($coordinates !== null) {
            $this->coordinate_id = $coordinates->mrge_id;
        } else {
            $this->coordinate_id = null;
        }
        $this->address          = $address;
        $this->city             = $city;
        $this->state            = $state;
        $this->zipcode          = $zipcode;

        $this->save();

        return $this;

    }


}
