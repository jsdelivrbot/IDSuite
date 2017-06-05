<?php

namespace App;

use App\Model as Model;

class Coordinate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lat', 'long'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    protected $guarded = [
        'class_code'
    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "coordinate";


    public $incrementing = false;


    protected $keyType = 'uuid';

    /**
     * Coordinate constructor.
     * @param array $attributes
     * @internal param Float $lat
     * @internal param Float $long
     * @internal param $contact /App/Contact
     * @internal param string $password
     */
    public function __construct( $attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.


    }
}
