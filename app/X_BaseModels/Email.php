<?php

namespace App;

use App\Model as Model;

class Email extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address', 'username_prefix', 'host', 'top_level_domain'
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
    protected $table = "email";

//    protected $guarded = [
//        'class_code'
//    ];

    /**
     * Email constructor.
     * @param string $email_address
     * @param array $attributes
     */
    public function __construct($email_address, $attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        $this->address = $email_address;

        $this->username_prefix = null;
        $this->host = null;
        $this->top_level_domain = null;


        // TODO split string stuff to get the rest of the attributes.

        $this->save();

    }
}
