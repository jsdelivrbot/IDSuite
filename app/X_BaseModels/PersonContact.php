<?php

namespace App;


use App\Model as Model;


/**
 * App\PersonContact
 *
 * @property string $id
 * @property string $class_code
 * @property string|null $personname_id
 * @property string|null $email_id
 * @property string|null $location_id
 * @property string|null $phonenumber_id
 * @property string|null $user_id
 * @property string|null $entity_id
 * @property int|null $active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Email $email
 * @property-read \App\Entity $entity
 * @property-read \App\Location $location
 * @property-read \App\PersonName $name
 * @property-read \App\PhoneNumber $phonenumber
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonContact whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonContact whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonContact whereEmailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonContact whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonContact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonContact whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonContact wherePersonnameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonContact wherePhonenumberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonContact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PersonContact whereUserId($value)
 * @mixin \Eloquent
 */
class PersonContact extends Model
{

    protected $guarded = [
        'updated_at', 'created_at'
    ];


    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "personcontact";

    public $incrementing = false;

    protected $keyType = 'uuid';

    /**
     * relationships
     */
    public function name(PersonName $p = null)
    {
        if ($p !== null) {
            $this->personname_id = $p->id;
        }
        return $this->hasOne(PersonName::class, 'id', 'personname_id');
    }

    public function email(Email $e = null)
    {
        if ($e !== null) {
            $this->email_id = $e->id;
        }
        return $this->hasOne(Email::class, 'id', 'email_id');
    }

    public function location(Location $l = null)
    {
        if ($l !== null) {
            $this->location_id = $l->id;
        }
        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    public function phonenumber(PhoneNumber $p = null)
    {
        if ($p !== null) {
            $this->phonenumber_id = $p->id;
        }
        return $this->hasOne(PhoneNumber::class, 'id', 'phonenumber_id');
    }

    public function entity(Entity $e = null)
    {
        if ($e !== null) {
            $this->entity_id = $e->id;
        }
        return $this->belongsTo(Entity::class, 'id', 'entity_id');
    }

    /**
     * Contact constructor.
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
     * getContactByEmail
     *
     * @param $email
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public static function getContactByEmail($email)
    {
        return PersonContact::where('email_id', $email->id)->first();
    }

}
