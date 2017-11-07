<?php

namespace App;

use App\Model as Model;

/**
 * App\AnalyticValueCache
 *
 * @property string $id
 * @property string $class_code
 * @property int|null $value
 * @property int|null $active
 * @property string|null $analytic_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Analytic $analytic
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnalyticValueCache whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnalyticValueCache whereAnalyticId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnalyticValueCache whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnalyticValueCache whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnalyticValueCache whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnalyticValueCache whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnalyticValueCache whereValue($value)
 * @mixin \Eloquent
 */
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
