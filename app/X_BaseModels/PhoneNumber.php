<?php

namespace App;

use App\Model as Model;
use Mockery\Exception;

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
     * Email constructor.
     * @param array $attributes
     */
    public function __construct($phonenumber = null, $type=null, $attributes = array())  {
        parent::__construct($attributes);
        // Your construct code.

        if (!empty($phonenumber)) {
            $this->phone_type = $type;

            if ($phonenumber !== null || empty($phonenumber)) {

                if (strlen($phonenumber) === 10) {
                    $this->rawnumber = $phonenumber;

                    $area_code = substr($phonenumber, 0, 3);
                    $exchange = substr($phonenumber, 3, 3);
                    $number = substr($phonenumber, 6, 4);

                    $this->area_code = $area_code;
                    $this->exchange = $exchange;
                    $this->number = $number;

                    $this->formnumber = "($this->area_code) $this->exchange-$this->number";

                } elseif (strlen($phonenumber) === 8) {

                    $this->rawnumber = $phonenumber;
                    $this->area_code = null;
                    $this->exchange = substr($phonenumber, 0, 3);
                    $this->number = substr($phonenumber, 3, 4);
                    $this->formnumber = "$this->exchange-$this->number";

                } else {

                    $this->rawnumber = $phonenumber;
                    $this->area_code = null;
                    $this->exchange = null;
                    $this->number = null;
                    $this->formnumber = null;

                    return $this;
                }
            } else {

                $this->rawnumber = $phonenumber;
                $this->area_code = $phonenumber;
                $this->exchange = $phonenumber;
                $this->number = $phonenumber;
                $this->formnumber = $phonenumber;

                return $this;

            }
        } else {
            return $this;
        }

    }

}
