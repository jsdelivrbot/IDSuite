<?php

namespace App;


use App\Model as Model;


class Contact extends Model
{

    protected $guarded = [
        'updated_at', 'created_at'
    ];

    public $incrementing = false;

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "contact";

    /**
     * relationships
     */
    public function personname(){
//        return $this->hasOne('App\PersonName', 'id', 'personname_id');
        return $this->hasOne(PersonName::class, 'id', 'personname_id');
    }

    public function email(){
//        return $this->hasOne(Email::class, 'id', 'email_id');
        return $this->hasOne(Email::class, 'id', 'email_id');
    }

    public function location(){
//        return $this->hasOne(Location::class, 'id', 'location_id');
        return $this->hasOne(Location::class, 'id', 'location_id');
    }




    /**
     * Contact constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        return $this;
    }





}
