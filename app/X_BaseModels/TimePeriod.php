<?php

namespace App;

use App\Model as Model;

class TimePeriod extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start', 'end'
    ];

    protected $guarded = [
        'duration', 'created_at', 'updated_at'
    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "timeperiod";

    public $incrementing = false;

    protected $keyType = 'uuid';

    /**
     * timeperiod constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        return $this;

    }


    public function setDuration(){
        $start  = strtotime($this->start);
        $end = strtotime($this->end);

        $this->duration = $end - $start;
        $this->save();

        return $this;
    }
}
