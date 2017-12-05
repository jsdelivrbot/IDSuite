<?php

namespace App;

use App\Enums\EnumDataSourceType;
use App\Enums\EnumOriginType;
use App\Enums\EnumPriorityType;
use App\Enums\EnumTicketStatusType;
use App\Model as Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * App\Ticket
 *
 * @property string $id
 * @property string|null $entity_id
 * @property string|null $user_id
 * @property string|null $personcontact_id
 * @property int|null $origin_type
 * @property int|null $ticket_type
 * @property int|null $priority_type
 * @property int|null $status_type
 * @property string $class_code
 * @property string|null $subject
 * @property string|null $ticket_date
 * @property string|null $last_message_date
 * @property int|null $known
 * @property int|null $active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\User $assigned_user
 * @property-read \App\Entity $entity
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereIncidentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereKnown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereLastMessageDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereOriginType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket wherePersoncontactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket wherePriorityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereStatusType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereTicketType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereUserId($value)
 * @mixin \Eloquent
 */
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
            $references->attach($dynamic_enum_value, ['dynamic_enum_id' => $dynamic_enum_value->definition->id, 'value_type' => $dynamic_enum_value->value_type]);
        }

        $ref_array = array();

        foreach($references->get() as $reference){

            $ref_array[EnumDataSourceType::getValueByKey($reference->value_type)] = $reference->value;
        }

        return $ref_array;
    }

    /**
     *
     * constructor
     *
     * @param array $attributes
     */
    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        return $this;

    }


    public function ConvertNs($ns_ticket) {


        if(!isset($ns_ticket->company->internalId) || !isset($ns_ticket->assigned->internalId) || !isset($ns_ticket->internalId))
            return false;
        /** check if company exist
         * @var Entity $entity
         */
        $entity = Entity::getObjectByRefId('reference_key', 'netsuite', $ns_ticket->company->internalId);


       $this->entity_id = (!$entity)  ? null : $entity->id;
        /** check if employee exist
         * @var User $user
         */
        $user = User::getObjectByRefId('reference_key', 'netsuite', $ns_ticket->assigned->internalId);

     //   dd($user);
        $this->user_id = (!$user) ? null : $user->id;

        $this->ticket_type = (isset($ns_ticket->category->internalId)) ? $ns_ticket->category->internalId : null;


        $this->priority_type = (isset($ns_ticket->priority->name)) ? EnumPriorityType::getKeyByValue($ns_ticket->priority->name)  : EnumPriorityType::getKeyByValue("unknown");
        $this->status_type = (isset($ns_ticket->status->name)) ? EnumTicketStatusType::getKeyByValue($ns_ticket->status->name) : EnumTicketStatusType::getKeyByValue("unknown");;
        $this->origin_type = (isset($ns_ticket->origin->name)) ? EnumOriginType::getKeyByValue($ns_ticket->origin->name) : EnumOriginType::getKeyByValue("unknown");
        $this->subject = (isset($ns_ticket->title)) ? $ns_ticket->title : null;
        $this->message_in = (isset($ns_ticket->incomingMessage)) ? $ns_ticket->incomingMessage : null;
        $this->message_out = (isset($ns_ticket->outgoingMessage)) ? $ns_ticket->outgoingMessage : null;
        $this->case_number = (isset($ns_ticket->caseNumber)) ? $ns_ticket->caseNumber : null;
        $this->incident_date = (isset($ns_ticket->startDate)) ? $ns_ticket->startDate : null;

        $this->last_message_date =(isset($ns_ticket->lastMessageDate)) ? $ns_ticket->lastMessageDate : null;

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

        $incident_date = new \DateTime($this->ticket_date);

        if($time === null) {
            $time = new \DateTime();

            $duration = $time->getTimestamp() - $incident_date->getTimestamp();
        } else {
            $duration = $time->getTimestamp() - $incident_date->getTimestamp();
        }

        return $duration;
    }





}
