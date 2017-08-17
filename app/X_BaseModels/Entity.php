<?php

namespace App;

use App\Model as Model;
use App\Enums\EnumDataSourceType;

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
    protected $relationships = [
        'contact', 'parent', 'users', 'persons', 'sites'
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

        return $this->hasOne(Entity::class, 'id', 'parent_id');
    }

    // one to many
    public function persons(){
        return $this->hasMany(PersonContact::class);
    }

    public function sites(){
        return $this->hasMany(EntityContact::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }

    public function children(){
        return $this->hasMany(Entity::class, 'parent_id', 'id');
    }

    // many to one
    public function endpoints(){
        return $this->hasMany(Endpoint::class, 'entity_id', 'id');
    }


    // many to many //
    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * Get all of the entity's notes.
     */
    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function references(DynamicEnumValue $dynamic_enum_value = null){

        $references = $this->morphToMany(DynamicEnumValue::class, 'object','object_dev')->withTimestamps();

        if($dynamic_enum_value !== null) {
            $references->attach($dynamic_enum_value, ['dynamic_enum_id' => $dynamic_enum_value->definition->id]);
        }

        $ref_array = array();

        foreach($references->get() as $reference){

            $ref_array[EnumDataSourceType::getValueByKey($reference->value_type)] = $reference->value;
        }

        return $ref_array;
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

    public static function getByName($name) {
        $name = EntityName::where('name', $name)->first();

        if($name === null){
            return $name;
        } else {
            $entity = $name->entitycontact->entity;
            return $entity;
        }

    }

}
