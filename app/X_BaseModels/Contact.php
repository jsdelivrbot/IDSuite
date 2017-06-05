<?php

namespace \App\;

use App\Email;
use App\Location;
use App\PersonName;

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

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "contact";

    /**
     * relationships
     */
    public function personname(){
        return $this->hasOne('App\PersonName', 'mrge_id');
    }

    public function email(){
        return $this->hasOne('App\Email', 'mrge_id');
    }

    public function location(){
        return $this->hasOne('App\Location', 'mrge_id');
    }

    /**
     * Contact constructor.
     * @param PersonName|array $personname
     * @param Email|string $email string
     * @param Location|null $location
     * @param array $attributes
     * @internal param string $firstname
     * @internal param string $lastname
     * @internal param string $password
     */
    public function __construct(PersonName $personname = null, Email $email = null, Location $location = null, $attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        if($personname !== null) {
            $this->personname = $personname->mrge_id;
        } else {
            $this->personname = null;
        }
        if($email !== null) {
            $this->email = $email->mrge_id;
        } else {
            $this->email = null;
        }
        if($location !== null) {
            $this->location = $location->mrge_id;
        } else {
            $this->location = null;
        }
        $this->save();

    }





}
