<?php

namespace App;


use App\Model as Model;


class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'personname', 'email', 'location'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];


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
        return $this->hasOne('App\PersonName', 'mrge_id', 'person_name_id');
    }

    public function email(){
        return $this->hasOne('App\Email', 'mrge_id', 'email_id');
    }

    public function location(){
        return $this->hasOne('App\Location', 'mrge_id', 'location_id');
    }



    /**
     * Contact constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.


        $this->save();

        return $this;
    }





}
