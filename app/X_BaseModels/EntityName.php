<?php

namespace App;

use App\Model as Model;

/**
 * App\EntityName
 *
 * @property string $id
 * @property string $class_code
 * @property string|null $name
 * @property int|null $active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\EntityContact $entitycontact
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EntityName whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EntityName whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EntityName whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EntityName whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EntityName whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EntityName whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    public function entitycontact(EntityContact $ec = null)
    {
        if ($ec !== null) {
            $this->entitycontact_id = $ec->id;
        }
        return $this->belongsTo(EntityContact::class, 'id', 'entityname_id');
    }


    /**
     * personname constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())
    {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        return $this;

    }
}
