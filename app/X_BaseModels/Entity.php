<?php

namespace App;

use App\Model as Model;
use App\Enums\EnumDataSourceType;
use Carbon\Carbon;

/**
 * App\Entity
 *
 * @property string $id
 * @property string $class_code
 * @property string|null $contact_id
 * @property string|null $parent_id
 * @property int|null $active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity[] $children
 * @property-read \App\EntityContact $contact
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Endpoint[] $endpoints
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Note[] $notes
 * @property-read \App\Entity $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PersonContact[] $persons
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\EntityContact[] $sites
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Ticket[] $tickets
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Record[] $records
 */
class Entity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_id', 'parent_id'
    ];
    protected $relationships = [
        'contact', 'parent', 'users', 'persons', 'sites'
    ];
    protected $guarded = [
        'created_at', 'updated_at'
    ];

    /**
     * Define table to be used with this model. It defaults and assumes table names will have an s added to the end.
     *for instance App\User table by default would be users
     */
    protected $table = "entity";

    public $incrementing = false;

    protected $keyType = 'uuid';

    /**
     *
     * relationships
     *
     */

    // one to one //
    public function contact(EntityContact $c = null)
    {

        if ($c !== null) {
            $this->contact_id = $c->id;
        }

        return $this->hasOne(EntityContact::class);
    }

    public function parent(Entity $e = null)
    {

        if ($e !== null) {
            $this->parent_id = $e->id;
        }

        return $this->hasOne(Entity::class, 'id', 'parent_id');
    }

    // one to many
    public function persons()
    {
        return $this->hasMany(PersonContact::class);
    }

    public function sites()
    {
        return $this->hasMany(EntityContact::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function children()
    {
        return $this->hasMany(Entity::class, 'parent_id', 'id');
    }


    // many to many //
    public function endpoints()
    {
        return $this->hasMany(Endpoint::class, 'entity_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function references(DynamicEnumValue $dynamic_enum_value = null)
    {

        $references = $this->morphToMany(DynamicEnumValue::class, 'object', 'object_dev')->withTimestamps();

        if ($dynamic_enum_value !== null) {
            $references->attach($dynamic_enum_value, ['dynamic_enum_id' => $dynamic_enum_value->definition->id, 'value_type' => $dynamic_enum_value->value_type]);
        }

        $ref_array = array();

        foreach ($references->get() as $reference) {

            $ref_array[EnumDataSourceType::getValueByKey($reference->value_type)] = $reference->value;
        }

        return $ref_array;
    }

    public function records(){
        return $this->hasMany(Record::class, 'entity_id', 'id');
    }


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
     * getByName
     *
     * @param $name
     * @return bool
     */
    public static function getByName($name)
    {
        $name = \DB::select("
                  SELECT entity.* 
                  FROM entity 
                  LEFT JOIN entitycontact on entitycontact.entity_id = entity.id
                  LEFT JOIN entityname on entitycontact.entityname_id = entityname.id
                  WHERE entityname.name = '$name'
                  ");

        if ($name === null) {
            return false;
        } else {
            return self::getObjectById($name[0]->id);
        }

    }

    /**
     *
     * getAllRecords
     *
     * @return array
     */
    public function getAllRecords()
    {

        $records_array = array();

        foreach ($this->endpoints as $endpoint) {
            foreach ($endpoint->records as $record) {
                $records_array[] = $record;
            }
        }

        return $records_array;

    }



    public function getMostRecentRecordDate(){
        $record = \DB::select("
                  SELECT record.*, timeperiod.start as timeperiod_start 
                  FROM record 
                  LEFT Join timeperiod on record.timeperiod_id = timeperiod.id
                  WHERE record.entity_id = '$this->id'
                  ORDER BY timeperiod_start DESC
                  LIMIT 1
                  ");

        if(count($record) === 0){
            return 0;
        } else {
            return $record[0]->timeperiod_start;
        }
    }


    /**
     * @param Carbon $start_date
     * @return mixed
     */
    public function getRecordsByDate(Carbon $start_date = null){

        if($start_date === null){
            return \DB::select("select record.*, timeperiod.start as timeperiod_start, timeperiod.duration as timeperiod_duration from record LEFT join timeperiod on record.timeperiod_id=timeperiod.id where record.entity_id = '$this->id'");
        } else {
            $start_date = $start_date->toDateString();
            return \DB::select("select record.*, timeperiod.start as timeperiod_start, timeperiod.duration as timeperiod_duration from record LEFT join timeperiod on record.timeperiod_id=timeperiod.id where timeperiod.start > '$start_date' AND record.entity_id = '$this->id'");
        }
    }


    public function getMonitoredStartDate()
    {

        $record = \DB::select("
                  SELECT record.*
                  FROM record 
                  WHERE record.entity_id = '$this->id'
                  ORDER BY record.created_at ASC
                  LIMIT 1
                  ");


        if(count($record) === 0){
            return 0;
        } else {
            return $record[0]->created_at;
        }

    }

}
