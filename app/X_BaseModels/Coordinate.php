<?php

namespace App;

use App\Model as Model;
use Illuminate\Support\Facades\Log;

class Coordinate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lat', 'lng'
    ];

    protected $guarded = [
        'updated_at', 'created_at'
    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "coordinate";

    public $incrementing = false;

    protected $keyType = 'uuid';

//    public function location(){
//        return this->$this->belongsTo()
//    }

    /**
     * Coordinate constructor.
     * @param array $attributes
     * @internal param Float $lat
     * @internal param Float $long
     * @internal param $contact /App/Contact
     * @internal param string $password
     */
    public function __construct( $attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        return $this;
    }

    /**
     *
     * This uses Google Api request for coordinates from a Location class object unless you set the second parameter to false.
     * Then the first parameter can be an address string
     *
     * @param mixed $location
     * @param bool $isLocationObject
     * @return mixed
     * @throws \Exception
     */
    public static function getCoordinatesFromLocation($location, $isLocationObject){

        $googleUrl = env("GOOGLE_URL");
        $googleApiKey = env("GOOGLE_API_KEY");

        if($isLocationObject) {
            $full_address = $location->address . $location->city . $location->state . $location->zip;
        } else {
            $full_address = $location;
        }

        $post_parameters = array(
            'address'   => $full_address,
            'key'       => $googleApiKey
        );

        $post_parameters = http_build_query($post_parameters, '', '&');

        $request_url = $googleUrl . $post_parameters;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        $response = json_decode($response);
        $status = $response->status;

        if(property_exists($response, 'error_message')){
            throw new \Exception("Class: Coordinates \n Method: getCoordinatesFromLocation \n Message: There was an error with the Google Maps API request Message : " . $response->error_message . "\n The request URL : " . $request_url, 500);
        } else {
            switch ($status){
                case 'OK':
                    $coordinates = $response->results[0]->geometry->location;
                    return $coordinates;
                    break;
                case 'ZERO_RESULTS':
                    throw new \Exception("Zero_Results", 200);
                    break;
                default:
                    return false;
                    break;
            }
        }
    }

    /**
     *
     * create a Coordinate class object from a Location class object
     *
     * @param Location $location
     * @return Coordinate|bool
     */
    public static function createCoordinatesFromLocation (Location $location){
        try {
            $coordinates = self::getCoordinatesFromLocation($location, true);
            $coordinates = new Coordinate([
                'lat' => $coordinates->lat,
                'lng' => $coordinates->lng
            ]);
        } catch (\Exception $e){
            Log::warning("Class: Coordinates \n Method: createCoordinatesFromLocation \n Location: " . $location->mrge_id . " failed to create coordinates. \n Error Message: " . $e->getMessage());
            return false;
        }

        return $coordinates;
    }


    /**
     *
     *  create a Coordinate class object from address sting
     *
     * @param string $address
     * @return Coordinate|bool
     */
    public static function createCoordinatesFromAddress ($address){
        try {
            $coordinates = self::getCoordinatesFromLocation($address, false);
            $coordinates = new Coordinate([
                'lat' => $coordinates->lat,
                'lng' => $coordinates->lng
            ]);
        } catch (\Exception $e){
            Log::warning("Class: Coordinates \n Method: createCoordinatesFromAddress \n Address: " . $address . " failed to create coordinates. \n Error Message: " . $e->getMessage());
            return false;
        }

        return $coordinates;
    }

}
