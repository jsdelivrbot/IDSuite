<?php

namespace App;

use App\Model as Model;
use Mockery\Exception;

/**
 * App\Location
 *
 * @property string $id
 * @property string $class_code
 * @property string|null $coordinate_id
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $zipcode
 * @property string|null $country_code
 * @property string|null $time_zone
 * @property int|null $active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Coordinate $coordinate
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereCoordinateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereTimeZone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereZipcode($value)
 * @mixin \Eloquent
 */
class Location extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coordinate', 'address', 'city', 'state', 'zipcode', 'country_code', 'time_zone'
    ];


    protected $guarded = [
        'created_at', 'updated_at'
    ];

    protected $relationships = [
        'coordinate'
    ];
    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "location";

    public $incrementing = false;

    protected $keyType = 'uuid';

    /**
     * relationships
     */
    public function coordinate(Coordinate $c = null)
    {

        if ($c !== null) {
            $this->coordinate_id = $c->id;
        }

        return $this->hasOne(Coordinate::class);
    }

    // we may want to have a proxies relationship //


    /**
     * Location constructor.
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
     * Create Coordinates from a Instance Method.
     *
     * @return $this|bool $mixed
     */
    public function createCoordinatesGoogle()
    {
        try {
            $coordinates = Coordinate::createCoordinatesFromLocation($this);
            if ($coordinates !== false) {
                $coordinates->save();
            }
//            $this->coordinate = $coordinates;
            $this->coordinate_id = $coordinates->id;
            $this->save();
        } catch (\Exception $e) {
            \Log::warning("Class: Location \n Method: createCoordinates \n Location: " . $this->mrge_id . " failed to create coordinates. \n Error Message: " . $e->getMessage());
        }

        return $this;
    }

}
