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
        'contact_id', 'parent_id', 'user_id'
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


    /**
     * relationships
     */
    public function contact(){
        return $this->hasOne(EntityContact::class);
    }

    public function parent(){
        return $this->hasOne(Entity::class);
    }

    public function user(){
        return $this->hasOne(User::class);
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
