<?php

namespace App;

use App\Model as Model;

class Record extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'endpoint', 'timeperiod', 'local_id', 'conf_id', 'local_name', 'local_number', 'remote_name', 'remote_number', 'dialed_digits', 'direction', 'protocol'
    ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "record";

    public $incrementing = false;

    /**
     * relationships
     */
    public function endpoint(){
        return $this->hasOne('App\Endpoint', 'mrge_id', 'endpoint_id');
    }

    public function timeperiod(){
        return $this->hasOne('App\TimePeriod', 'mrge_id', 'timeperiod_id');
    }


    /**
     * User constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        $this->save();

        return $this;

    }
}
