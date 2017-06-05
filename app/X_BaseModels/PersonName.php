<?php

namespace App;

use App\Model as Model;

class PersonName extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'middle_name', 'preferred_name', 'title'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

//    protected $guarded = [
//        'classcode'
//    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "personname";


    /**
     * personname constructor.
     * @param array $attributes
     */
    public function __construct($first_name, $last_name, $attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->middle_name = null;
        $this->preferred_name = null;
        $this->title = null;

        $this->save();

    }
}
