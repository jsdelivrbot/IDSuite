<?php

namespace App;

use App\Model as Model;

class AnalyticValueCache extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "analytic_value_cache";

    public $incrementing = false;

    protected $keyType = 'uuid';

    /**
     * relationships
     */

        /**
     * Get all of the owning analytic models.
     */
    public function analytic(Analytic $a = null)
    {
        if($a !== null) {
            $this->analytic_id = $a->id;
        }

        return $this->hasOne(Analytic::class, 'id', 'analytic_id');
    }


    /**
     * personname constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        $this->active = 1;

        return $this;

    }

}
