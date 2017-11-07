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

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "personname";

    public $incrementing = false;

    protected $keyType = 'uuid';

    /**
     *
     * Relationships
     *
     */
    public function personcontact(PersonContact $p = null)
    {
        if ($p !== null) {
            $this->personcontact_id = $p->id;
        }
        return $this->hasOne(PersonContact::class, 'id', 'personcontact_id');
    }

    /**
     *
     * constructor
     *
     * @param array $attributes
     */
    public function __construct($attributes = array())
    {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        return $this;

    }
}
