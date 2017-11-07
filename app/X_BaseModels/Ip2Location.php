<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;


/**
 * App\Ip2Location
 *
 * @property int|null $ip_from
 * @property int|null $ip_to
 * @property string|null $country_code
 * @property string|null $country_name
 * @property string|null $region_name
 * @property string|null $city_name
 * @property string|null $zip_code
 * @property string|null $time_zone
 * @property float|null $latitude
 * @property float|null $longitude
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ip2Location whereCityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ip2Location whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ip2Location whereCountryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ip2Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ip2Location whereIpFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ip2Location whereIpTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ip2Location whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ip2Location whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ip2Location whereRegionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ip2Location whereTimeZone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ip2Location whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ip2Location whereZipCode($value)
 * @mixin \Eloquent
 */
class Ip2Location extends Model
{

    protected $fillable = [
        'ip_from', 'ip_to', 'country_code', 'country_name', 'region_name', 'city_name', 'latitude', 'longitude', 'zip_code', 'time_zone'
    ];


    protected $guarded = [
        'created_at', 'updated_at'
    ];

    protected $table = "ip2location";

    public $incrementing = false;

    protected $keyType = 'integer';


    /**
     * constructor.
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
     * getByIp
     *
     * @param $ip
     * @return bool|Model|null|static
     */
    public static function getByIp($ip)
    {

        $ip_long = ip2long($ip);

        if ($ip_long) {
            $location_details = (new Ip2Location)->where('ip_to', '>=', $ip_long)->limit(1)->first();
        } else {
            // TODO throw exceptions
//            throw new Exception('Ip must be numeric');

            return false;
        }
        return $location_details;
    }


}
