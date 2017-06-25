<?php

namespace App;


use App\Model as Model;


class EntityContact extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];

    protected $guarded = [
        'updated_at', 'created_at'
    ];

    public $incrementing = false;

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "entitycontact";

    protected $keyType = 'uuid';

    /**
     * relationships
     */
    public function entityname(EntityName $e = null){
        if($e !== null){
            $this->entityname_id = $e->id;
        }

        return $this->hasOne(EntityName::class, 'id', 'entityname_id');
    }

    public function email(Email $e = null){
        if($e !== null){
            $this->email_id = $e->id;
        }

        return $this->hasOne(Email::class, 'id', 'email_id');
    }

    public function location(Location $l = null){

        if($l !== null){
            $this->location_id = $l->id;
        }

        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    public function phonenumber(PhoneNumber $p = null){
        if($p !== null){
            $this->phonenumber_id = $p->id;
        }

        return $this->hasOne(PhoneNumber::class, 'id', 'phonenumber_id');
    }

    public function entity(Entity $e = null){
        if($e !== null){
            $this->entity_id = $e->id;
        }
        return $this->belongsTo(Entity::class, 'id', 'entity_id');
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
