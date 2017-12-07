<?php

namespace App;

use App\Model as Model;

/**
 * App\PersonName
 *
 * @property string $id
 * @property string $class_code
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $middle_name
 * @property string|null $preferred_name
 * @property string|null $title
 * @property string|null $personcontact_id
 * @property int|null $active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\PersonContact $personcontact
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonName whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonName whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonName whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonName whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonName whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonName whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonName whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonName wherePersoncontactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonName wherePreferredName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonName whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonName whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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


    /**
     *
     * getFullName
     *
     * returns the concatenation of first and last name.
     *
     * @return string
     */
    public function getFullName()
    {

        return "$this->first_name $this->last_name";

    }
}
