<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;


class Ip2Location extends Model
{

    protected $fillable = [
        'ip_from', 'ip_to', 'country_code', 'country_name', 'region_name', 'city_name', 'latitude', 'longitude', 'zip_code','time_zone'
    ];


    protected $guarded = [
        'created_at', 'updated_at'
    ];

    protected $table = "ip2location";

    public $incrementing = false;

    protected $keyType = 'integer';



    /**
     * User constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.
        return $this;
    }

    public static function getByIp($ip){

        $ip_long = ip2long($ip);

        if($ip_long) {
            $location_details = Ip2Location::where('ip_to', '>=', $ip_long)->limit(1)->first();
        } else {
            // TODO throw exceptions
//            throw new Exception('Ip must be numeric');

            return false;
        }
        return $location_details;
    }


}
