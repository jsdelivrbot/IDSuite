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
        'endpoint', 'timeperiod', 'local_id', 'conf_id', 'local_name', 'local_number', 'remote_name', 'remote_number', 'dialed_digits', 'direction', 'protocol', 'id'
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

    protected $keyType = 'uuid';

    /**
     * relationships
     */
    public function endpoint(Endpoint $e = null){
        if($e !== null){
            $this->endpoint_id = $e->id;
        }
        return $this->hasOne(Endpoint::class, 'id', 'endpoint_id');
    }

    public function timeperiod(TimePeriod $t = null){
        if($t !== null){
            $this->timeperiod_id = $t->id;
        }
        return $this->hasOne(TimePeriod::class, 'id','timeperiod_id');
    }


    /**
     * User constructor.
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        return $this;

    }


    public function process(){
        $analytics = $this->endpoint->analytics;

        foreach ($analytics as $analytic){

            $property_relationship = $analytic->analytic_object_relationship;
            $property_name = $analytic->analytic_object_property;

            switch ($analytic->analytic_type){
                case 0:
                    if(is_null($property_relationship)) {
                        if(!is_null($this->$property_name)) {
                            $analytic->value++;
                            $analytic->save();
                        }
                    } else {
                        if(!is_null($this->$property_relationship->$property_name)){
                            $analytic->value++;
                            $analytic->save();
                        }
                    }
                    break;
                case 1:
                    if(is_null($property_relationship)) {
                        if(!is_null($this->$property_name)) {
                            $analytic->value = $analytic->value + $this->$property_name;
                            $analytic->save();
                        }
                    } else {
                        if(!is_null($this->$property_relationship->$property_name)){
                            $analytic->value = $analytic->value + $this->$property_relationship->$property_name;
                            $analytic->save();
                        }
                    }
                    break;
                case 2:

                    break;
                case 3:

                    break;
                case 4:

                    break;
                case 5:
                    if(!is_null($analytic->numerator) && !is_null($analytic->denominator)){
                        $analytic->value = round($analytic->numerator->value / $analytic->denominator->value, 8);
                        $analytic->save();
                    }
                    break;
            }
        }
    }
}
