<?php

namespace App;


use App\Model as Model;


class EntityContact extends Model
{

    protected $guarded = [
        'updated_at', 'created_at'
    ];

    public $incrementing = false;

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "entitycontact";

    /**
     * relationships
     */
    public function entityname(){
        return $this->hasOne(EntityName::class, 'id', 'entityname_id');
    }

    public function email(){
        return $this->hasOne(Email::class, 'id', 'email_id');
    }

    public function location(){
        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    public function phonenumber(){
        return $this->hasOne(PhoneNumber::class, 'id', 'phonenumber_id');
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
