<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 9/28/17
 * Time: 11:09 AM
 */

namespace App;

use App\Model as Model;

class Pod extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'completed'
    ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    protected $table = "pod";

    public $incrementing = false;

    protected $keyType = 'uuid';


    /**
     * Relationships
     */
    public function participants(){
        return $this->belongsToMany(Participant::class)->withTimestamps();
    }

    public function __construct($attributes = array())  {
        parent::__construct($attributes);
        // Your construct code.

        $this->completed = false;

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


    public function setCompleted($value){
        $this->completed = $value;
        $this->save();
        return $this;
    }

    public function getCompleted(){
        return $this->completed;
    }


    public function joinSitter($sitter){
        $this->participants()->attach($sitter->id, ['active_status' => true]);

        $this->active_count = $this->active_count + 1;

        $this->total_count = $this->total_count + 1;

        $this->sitter_count = $this->sitter_count + 1;

        $this->save();

        return $this->getActiveParticipants();
    }

    public function dropSitter($sitter){
        $this->participants()->updateExistingPivot($sitter->id, ['active_status' => false]);

        if($this->active_count > 0) {
            $this->active_count = $this->active_count - 1;
        }

        if($this->sitter_count > 0) {
            $this->sitter_count = $this->sitter_count - 1;
        }

        $this->save();

        return $this->getActiveParticipants();
    }


    public function getActiveParticipants(){
        return $this->participants()->where('active_status', '=', true)->get();
    }

    public function joinParticipant($participant){
        $this->participants()->attach($participant->id, ['active_status' => true]);


        $this->active_count = $this->active_count + 1;

        $this->patient_count = $this->patient_count + 1;

        $this->total_count = $this->total_count + 1;

        $this->save();

        return $this->getActiveParticipants();
    }

    public function dropParticipant($participant){
        $this->participants()->updateExistingPivot($participant->id, ['active_status' => false]);

        if($this->active_count > 0) {
            $this->active_count = $this->active_count - 1;
        }

        if($this->patient_count > 0) {
            $this->patient_count = $this->patient_count - 1;
        }
        $this->save();

        return $this->getActiveParticipants();
    }


    public static function getPods($active = true){
        if(!$active) {
            return Pod::all();
        } else{
            return Pod::where("active", "=", 1)->get();
        }
    }

    public function generateCode(){

        $this->code = self::generateXDigitPin(4);

        $this->save();

        return $this;
    }

    public function destroyCode(){

        $this->code = null;

        $this->save();

        return $this;

    }

    private static function generateXDigitPin($numOfDigits){

        $pin = array();

        for($count = 0; $count < $numOfDigits; $count++){
            $number = rand(0,9);
            $pin[] = $number;
        }

        return implode("",$pin);

    }

    public static function getActivelyLooking(){

        return Pod::where("code", "!=", null)->where("active", "=", 1)->get();

    }
}