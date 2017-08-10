<?php

namespace App;

use App\Model as Model;

class Website extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url'
    ];

    protected $guarded = [
         'created_at', 'updated_at'
    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "Website";

    public $incrementing = false;

    protected $keyType = 'uuid';
    /**
     * Website constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        // TODO split string stuff to get the rest of the attributes.

        return $this;

    }


    /**
     *
     *  setWebsite on Website class object. it will also fill out the rest of the properties.
     *
     * @param string $address
     * @return $this
     */
    public function setWebsite($url = null){



        if (\App\Http\Controllers\Helper\Validation::isUrlValid($url) == false) {
            $this->url = null;
            $this->save();
            return $this;

       }else {
            $url = trim($url);

            $parsed_url = parse_url($url);
            /* revise for multi subdomain ex sub1.sub2.domain.com */
            list($sub_domain, $domain) = explode('.', $parsed_url['host'], 2);

            $this->url = $url;
            $this->protocol = $parsed_url['scheme'];
            $this->port = $parsed_url['port'];
            $this->user = $parsed_url['user'];
            $this->pass = $parsed_url['pass'];
            $this->host = $parsed_url['host'];
            $this->subdomain = $sub_domain;
            $this->domain = $domain;
            $this->path = $parsed_url['path'];
            $this->parameters = $parsed_url['query'];
            $this->fragment = $parsed_url['fragment'];

            $this->save();
            return $this;

        }
    }


}
