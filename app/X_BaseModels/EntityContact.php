<?php

namespace App;


use App\Model as Model;


/**
 * App\EntityContact
 *
 * @property string $id
 * @property string $class_code
 * @property string|null $entityname_id
 * @property string|null $email_id
 * @property string|null $location_id
 * @property string|null $phonenumber_id
 * @property string|null $website_id
 * @property int|null $active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Email $email
 * @property-read \App\Entity $entity
 * @property-read \App\Location $location
 * @property-read \App\EntityName $name
 * @property-read \App\PhoneNumber $phonenumber
 * @property-read \App\Website $website
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EntityContact whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EntityContact whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EntityContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EntityContact whereEmailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EntityContact whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EntityContact whereEntitynameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EntityContact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EntityContact whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EntityContact wherePhonenumberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EntityContact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EntityContact whereWebsiteId($value)
 * @mixin \Eloquent
 */
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

    protected $relationships = [
        'phonenumber', 'email', 'location', 'website'
    ];


    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "entitycontact";

    protected $keyType = 'uuid';

    public $incrementing = false;

    /**
     * relationships
     */
    public function name(EntityName $e = null)
    {
        if ($e !== null) {
            $this->entityname_id = $e->id;
        }

        return $this->hasOne(EntityName::class, 'id', 'entityname_id');
    }

    public function email(Email $e = null)
    {
        if ($e !== null) {
            $this->email_id = $e->id;
        }

        return $this->hasOne(Email::class, 'id', 'email_id');
    }

    public function website(Website $w = null)
    {
        if ($w !== null) {
            $this->website_id = $w->id;
        }

        return $this->hasOne(Website::class, 'id', 'website_id');
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

    /*
    public function entity(Entity $e = null)
    {
        if ($e !== null) {
            $this->entity_id = $e->id;
        }
        return $this->belongsTo(Entity::class, 'id', 'contact_id');
    }
*/

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

}
