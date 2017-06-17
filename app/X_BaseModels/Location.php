<?php

namespace App;

use App\Model as Model;
use Mockery\Exception;

class Location extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coordinate', 'address', 'city', 'state', 'zipcode'
    ];


    protected $guarded = [
        'created_at', 'updated_at'
    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "location";

    public $incrementing = false;

    /**
     * relationships
     */
    public function coordinate(){
        return $this->hasOne(Coordinate::class, 'id', 'coordinate_id');
    }



    /**
     * Location constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.


        return $this;

    }


    /**
     *
     * Create Coordinates from a Instance Method.
     * @return $this|bool $mixed
     */
    public function createCoordinates(){
        try {
            $coordinates = Coordinate::createCoordinatesFromLocation($this);
            if ($coordinates !== false) {
                $coordinates->save();
            }
//            $this->coordinate = $coordinates;
            $this->coordinate_id = $coordinates->id;
            $this->save();
        } catch (\Exception $e){
            \Log::warning("Class: Location \n Method: createCoordinates \n Location: " . $this->mrge_id . " failed to create coordinates. \n Error Message: " . $e->getMessage());
        }

        return $this;
    }

}
