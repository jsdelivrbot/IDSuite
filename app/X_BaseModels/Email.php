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

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "email";

    public $incrementing = false;

    /**
     * Email constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.


        // TODO split string stuff to get the rest of the attributes.

        $this->save();

        return $this;

    }
}
