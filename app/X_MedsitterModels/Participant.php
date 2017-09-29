<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 9/28/17
 * Time: 11:09 AM
 */

namespace App;

use App\Model as Model;

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


    public function setName($name){
        $this->name = $name;
        $this->save();
        return $this;
    }

    public function getName(){
        return $this->name;
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