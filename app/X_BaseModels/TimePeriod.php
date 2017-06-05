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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'duration'
    ];

//    protected $guarded = [
//        'classcode'
//    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "timeperiod";


    /**
     * timeperiod constructor.
     * @param array $start
     * @param $end
     * @param array $attributes
     */
    public function __construct($start = null, $end = null, $attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        $this->start    = $start;
        $this->end      = $end;

        if($this->start === null || $this->end === null) {
            $this->duration = null;
        } else {
            $this->duration = $end - $start;
        }

        $this->save();

    }
}
