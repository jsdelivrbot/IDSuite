<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 9/28/17
 * Time: 11:09 AM
 */

namespace App;

use App\Model as Model;

/**
 * App\Participant
 *
 * @property string $id
 * @property string $class_code
 * @property string|null $first_name
 * @property string|null $last_name
 * @property int|null $type
 * @property int|null $muted
 * @property int|null $active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Pod[] $participants
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Participant whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Participant whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Participant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Participant whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Participant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Participant whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Participant whereMuted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Participant whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Participant whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Participant extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'muted'
    ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    protected $table = "participant";

    public $incrementing = false;

    protected $keyType = 'uuid';


    /**
     * Relationships
     */
    public function participants(){
        return $this->belongsToMany(Pod::class)->withTimestamps();
    }

    public function __construct($attributes = array())  {
        parent::__construct($attributes);
        // Your construct code.

        return $this;
    }


    public function setFirstName($first_name){
        $this->first_name = $first_name;
        $this->save();
        return $this;
    }

    public function getFirstName(){
        return $this->first_name;
    }

    public function setLastName($last_name){
        $this->last_name = $last_name;
        $this->save();
        return $this;
    }

    public function getLastName(){
        return $this->last_name;
    }


    public function setMuted($value){
        $this->muted = $value;
        $this->save();
        return $this;
    }

    public function getMuted(){
        return $this->muted;
    }


    public function setType($type){
        $this->type = \App\Enums\EnumParticipantType::getKeyByValue($type);
        $this->save();
        return $this;
    }

    public function getType(){
        return $this->type;
    }




}