<?php

namespace App;

use App\Model as Model;

/**
 * App\Analytic
 *
 * @property string $id
 * @property string $class_code
 * @property string|null $endpoint_id
 * @property int $analytic_type
 * @property string $name
 * @property string|null $analytic_object_class
 * @property string|null $analytic_object_relationship
 * @property string|null $analytic_object_property
 * @property string|null $numerator_id
 * @property string|null $denominator_id
 * @property string|null $addend_one_id
 * @property string|null $addend_two_id
 * @property string|null $minuend_id
 * @property string|null $subtrahend_id
 * @property float|null $value
 * @property string|null $stringvalue
 * @property int|null $active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Analytic $addend_one
 * @property-read \App\Analytic $addend_two
 * @property-read \App\Analytic $denominator
 * @property-read \App\Endpoint $endpoint
 * @property-read \App\Analytic $minuend
 * @property-read \App\Analytic $numerator
 * @property-read \App\Analytic $subtrahend
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Analytic whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Analytic whereAddendOneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Analytic whereAddendTwoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Analytic whereAnalyticObjectClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Analytic whereAnalyticObjectProperty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Analytic whereAnalyticObjectRelationship($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Analytic whereAnalyticType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Analytic whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Analytic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Analytic whereDenominatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Analytic whereEndpointId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Analytic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Analytic whereMinuendId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Analytic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Analytic whereNumeratorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Analytic whereStringvalue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Analytic whereSubtrahendId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Analytic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Analytic whereValue($value)
 * @mixin \Eloquent
 */
class Analytic extends Model
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
    protected $table = "analytic";

    public $incrementing = false;

    protected $keyType = 'uuid';

    /**
     * relationships
     */

    // one to one //
    public function numerator(Analytic $a = null){

        if($a !== null) {
            $this->numerator_id = $a->id;
        }

        return $this->hasOne(Analytic::class, 'numerator_id', 'id');
    }

    public function denominator(Analytic $a = null){

        if($a !== null) {
            $this->denominator_id = $a->id;
        }

        return $this->hasOne(Analytic::class, 'denominator_id', 'id');
    }

    public function minuend(Analytic $a = null){

        if($a !== null) {
            $this->minuend_id = $a->id;
        }

        return $this->hasOne(Analytic::class, 'minuend_id', 'id');
    }

    public function subtrahend(Analytic $a = null){

        if($a !== null) {
            $this->subtrahend_id = $a->id;
        }

        return $this->hasOne(Analytic::class, 'subtrahend_id', 'id');
    }

    public function addend_one(Analytic $a = null){

        if($a !== null) {
            $this->addend_one_id = $a->id;
        }

        return $this->hasOne(Analytic::class, 'addend_one_id', 'id');
    }


    public function addend_two(Analytic $a = null){

        if($a !== null) {
            $this->addend_two_id = $a->id;
        }

        return $this->hasOne(Analytic::class, 'addend_two_id', 'id');
    }

    public function endpoint(Endpoint $e = null){
        if($e !== null){
            $this->endpoint_id = $e->id;
        }
        return $this->hasOne(Endpoint::class, 'id', 'endpoint_id');
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


    public function total(){

        $objects = $this->analytic_object_type->where('endpoint_id', $this->endpoint->id)->get();

        $total = count($objects);

        $avc = new AnalyticValueCache();

        $avc->value = $total;

        $avc->save();

        $avc->analytic($this)->save($this);

        $avc->save();

        return $total;
    }


    public static function resetAnalytics(){
        $analytics = Analytic::all();

        foreach ($analytics as $analytic){
            $analytic->value = 0;
            $analytic->save();

        }
    }
}
