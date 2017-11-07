<?php

namespace App;

use App\Model as Model;

/**
 * App\EndpointLog
 *
 * @mixin \Eloquent
 */
class EndpointLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message', 'event_type',
    ];

    protected $guarded = [
        'updated_at', 'created_at'
    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "endpoint_log";

    public $incrementing = false;

    protected $keyType = 'uuid';

    /**
     * EndpointLog constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())
    {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        return $this;
    }

}
