<?php

namespace App;


use App\Model as Model;


class PersonContact extends Model
{

    protected $guarded = [
        'updated_at', 'created_at'
    ];



    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "personcontact";

    public $incrementing = false;

    protected $keyType = 'uuid';

    /**
     * relationships
     */
    public function personname(){
        return $this->hasOne(PersonName::class, 'id', 'personname_id');
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

    public static function getContactByEmail($email     ){
        return PersonContact::where('email_id', $email->id)->first();
    }

}
