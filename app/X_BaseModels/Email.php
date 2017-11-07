<?php

namespace App;

use App\Model as Model;

class Email extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address'
    ];

    protected $guarded = [
        'username_prefix', 'host', 'top_level_domain', 'created_at', 'updated_at'
    ];


    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "email";

    public $incrementing = false;

    protected $keyType = 'uuid';


    /**
     * constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())
    {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        // TODO split string stuff to get the rest of the attributes.

        return $this;
    }

    /**
     *
     *  setEmail on Email class object. it will also fill out the rest of the properties.
     *
     * @param string $address
     * @return $this
     */
    public function setEmail($address = null)
    {

        $email_valid = filter_var($address, FILTER_VALIDATE_EMAIL);

        if ($email_valid) {
            $address_split = explode('@', $address);
            $postfix = $address_split[1];
            $postfix_split = explode('.', $postfix);

            $username = $address_split[0];
            $host = $postfix_split[0];
            $tld = $postfix_split[1];

            $this->address = $address;
            $this->username_prefix = $username;
            $this->host = $host;
            $this->top_level_domain = $tld;
            $this->save();

            return $this;
        } else {
            $this->address = null;
            $this->save();
            return $this;
        }
    }


    /**
     *
     * getEmailByAddress
     *
     * @param $address
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public static function getEmailByAddress($address)
    {
        return Email::where('address', $address)->first();
    }
}
