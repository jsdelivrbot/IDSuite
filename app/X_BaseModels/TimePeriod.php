<?php

namespace App;

use App\Model as Model;

/**
 * App\TimePeriod
 *
 * @property string $id
 * @property string $class_code
 * @property string|null $start
 * @property string|null $end
 * @property int|null $duration
 * @property int|null $active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TimePeriod whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TimePeriod whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TimePeriod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TimePeriod whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TimePeriod whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TimePeriod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TimePeriod whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TimePeriod whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
     *
     * constructor
     *
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
     * setDuration
     *
     * @return $this
     */
    public function setDuration()
    {
        $start = strtotime($this->start);
        $end = strtotime($this->end);

        $this->duration = $end - $start;
        $this->save();

        return $this;
    }
}
