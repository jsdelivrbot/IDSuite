<?php

namespace App;

use App\Model as Model;

class EntityName extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "entityname";

    public $incrementing = false;

    protected $keyType = 'uuid';

    public function entitycontact(EntityContact $ec = null){
        if($ec !== null) {
            $this->entitycontact_id = $ec->id;
        }
        return $this->belongsTo(EntityContact::class, 'id', 'entityname_id');
    }


    /**
     * personname constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        return $this;

    }
}
