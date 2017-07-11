<?php

namespace App;

use App\Model as Model;

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

    // TODO make this a one to many relationship
//    public function addends(){
//        return $this->hasMany(Analytic::class, 'addends_id', 'id');
//    }

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

//    public function avcs(){
//        return $this->hasMany()
//    }

//    /**
//     * Get all of the owning analytic models.
//     */
//    public function analytic_object()
//    {
//        return $this->morphTo();
//    }

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

        $objects = $this->analytic_object_type::where('endpoint_id', $this->endpoint->id)->get();

        $total = count($objects);

        $avc = new AnalyticValueCache();

        $avc->value = $total;

//        $avc->name = $this->name;

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
