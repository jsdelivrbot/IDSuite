<?php

namespace App;

use App\Model as Model;

class Entity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_id', 'parent_id'
    ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "entity";

    public $incrementing = false;

    protected $keyType = 'uuid';

    /**
     * relationships
     */

    // one to one //
    public function contact(EntityContact $c = null){

        if($c !== null) {
            $this->contact_id = $c->id;
        }

        return $this->hasOne(EntityContact::class);
    }

    public function parent(Entity $e = null){

        if($e !== null) {
            $this->parent_id = $e->id;
        }

        return $this->hasOne(Entity::class);
    }

    // one to many
    public function persons(){
        return $this->hasMany(PersonContact::class);
    }

    public function sites(){
        return $this->hasMany(EntityContact::class);
    }

    // many to one
    public function user(User $u = null){

        if($u !== null) {
            $this->user_id = $u->id;
        }

        return $this->belongsTo(User::class);
    }



    /**
     * personname constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        $this->active = 1;

        return $this;

    }

    public static function getByName($name){
        $name = EntityName::where('name', $name)->first();
        if(is_object($name)){
            $contact = EntityContact::where('entityname_id', $name->id)->first();
            if(is_object($contact)){
                $entity = Entity::where('contact_id', $contact->id)->first();
            } else {
                return false;
            }
        } else {
            return false;
        }
        return $entity;
    }
}
