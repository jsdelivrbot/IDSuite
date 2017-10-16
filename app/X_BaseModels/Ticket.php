<?php

namespace App;

use App\Enums\EnumDataSourceType;
use App\Model as Model;

class Ticket extends Model
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

    protected $table = "ticket";

    public $incrementing = false;

    protected $keyType = 'uuid';

    /**
     * relationships
     */
    public function entity(Entity $e = null){
        if($e !== null){
            $this->entity_id = $e->id;
        }

        return $this->hasOne(Entity::class, 'id', 'entity_id');
    }

    public function assigned_user(User $u = null){
        if($u !== null){
            $this->user_id = $u->id;
        }

        return $this->hasOne(User::class, 'id', 'user_id');
    }


    public function references(DynamicEnumValue $dynamic_enum_value = null){

        $references = $this->morphToMany(DynamicEnumValue::class, 'object','object_dev')->withTimestamps();

        if($dynamic_enum_value !== null) {
            $references->attach($dynamic_enum_value, ['dynamic_enum_id' => $dynamic_enum_value->definition->id]);
        }

        $ref_array = array();

        foreach($references->get() as $reference){

            $ref_array[EnumDataSourceType::getValueByKey($reference->value_type)] = $reference->value;
        }

        return $ref_array;
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


    /**
     *
     * duration()
     *
     * get duration/ellapsed time on a ticket. You can also pass in a dateTime to get the difference from a certain time.
     * return the number of seconds.
     *
     *
     * @param $time
     * @return mixed
     */
    public function duration(\DateTime $time = null){

        $incident_date = new \DateTime($this->incident_date);

        if($time === null) {
            $time = new \DateTime();

            $duration = $time->getTimestamp() - $incident_date->getTimestamp();
        } else {
            $duration = $time->getTimestamp() - $incident_date->getTimestamp();
        }

        return $duration;
    }



    /**
     * @param $value
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function searchByDevType($value){

        $type = EnumDataSourceType::getKeyByValue($value);

        $result = Ticket::join('object_dev', 'ticket.id', '=', 'object_dev.object_id')
                        ->where('value_type', '=', $type)
                        ->get();

        return $result;
    }

}
