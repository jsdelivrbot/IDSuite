<?php

namespace App;

use App\Model as Model;
use Mockery\Exception;

/**
 * App\PhoneNumber
 *
 * @property string $id
 * @property string $class_code
 * @property int|null $phone_type
 * @property string|null $country_code
 * @property string|null $rawnumber
 * @property int|null $digits
 * @property string|null $formnumber
 * @property int|null $area_code
 * @property int|null $exchange
 * @property int|null $number
 * @property int|null $active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneNumber whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneNumber whereAreaCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneNumber whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneNumber whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneNumber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneNumber whereDigits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneNumber whereExchange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneNumber whereFormnumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneNumber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneNumber whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneNumber wherePhoneType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneNumber whereRawnumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneNumber whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PhoneNumber extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'type'
    ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "phonenumber";

    public $incrementing = false;

    protected $keyType = 'uuid';


    /**
     * constructor.
     * @param null $phonenumber
     * @param null $type
     * @param array $attributes
     */
    public function __construct($phonenumber = null, $type = null, $attributes = array())
    {
        parent::__construct($attributes);
        // Your construct code.

        if (!empty($phonenumber)) {
            $this->phone_type = $type;
            $this->rawnumber = $phonenumber;


            if ($phonenumber !== null || empty($phonenumber)) {
                $this->digits = preg_replace("/[^0-9]/", "", $phonenumber);

                if (strlen($phonenumber) === 10) {

                    $area_code = substr($phonenumber, 0, 3);
                    $exchange = substr($phonenumber, 3, 3);
                    $number = substr($phonenumber, 6, 4);

                    $this->area_code = $area_code;
                    $this->exchange = $exchange;
                    $this->number = $number;

                    $this->formnumber = "($this->area_code) $this->exchange-$this->number";

                } elseif (strlen($phonenumber) === 8) {

                    $this->area_code = null;
                    $this->exchange = substr($phonenumber, 0, 3);
                    $this->number = substr($phonenumber, 3, 4);
                    $this->formnumber = "$this->exchange-$this->number";

                } else {

                    $this->area_code = null;
                    $this->exchange = null;
                    $this->number = null;
                    $this->formnumber = null;

                    return $this;
                }
            } else {

                $this->area_code = $phonenumber;
                $this->exchange = $phonenumber;
                $this->number = $phonenumber;
                $this->formnumber = $phonenumber;

                return $this;

            }
        }

        return $this;

    }

}
