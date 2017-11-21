<?php
/**
 * Created by PhpStorm.
 * User: fbreidi
 * Date: 10/11/2017
 * Time: 11:03 AM
 */

namespace App\Http\Controllers\Helper\Prepare;

use App\Enums\EnumDataSourceType;
use App\Http\Controllers\APIController;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Helper\Funcs;
class Record
{

    private $record; // \App\Record
    private $endpoint; // \App\Endpoint
    private $entity; // \App\Entity

    private $endpoint_id;
    private $entity_id;

    private $time_start;
    private $time_end;

    private $local_id;
    private $conference_id;

    private $tenant_name;



    private $type;
    private $local_name;
    private $local_number;
    private $remote_name;
    private $remote_number;
    private $dialed_digits;
    private $direction;
    private $protocol;

    /**
     * @return mixed
     */
    public function getTenantName()
    {
        return $this->tenant_name;
    }

    /**
     * @param mixed $tenant_name
     */
    public function setTenantName($tenant_name)
    {
        $this->tenant_name = $tenant_name;
    }
    /**
     * @return mixed
     */
    public function getConferenceId()
    {
        return $this->conference_id;
    }

    /**
     * @param mixed $conference_id
     */
    public function setConferenceId($conference_id)
    {
        $this->conference_id = $conference_id;
    }


    /**
     * @return mixed
     */
    public function getLocalId()
    {
        return $this->local_id;
    }

    /**
     * @param mixed $local_id
     */
    public function setLocalId($local_id)
    {
        $this->local_id = $local_id;
    }


    /**
     * @return mixed
     */
    public function getEndpointId()
    {
        return $this->endpoint_id;
    }

    /**
     * @param mixed $endpoint_id
     */
    public function setEndpointId($endpoint_id)
    {
        $this->endpoint_id = $endpoint_id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getTimeStart()
    {
        return $this->time_start;
    }

    /**
     * @param mixed $time_start
     */
    public function setTimeStart($time_start)
    {
        $this->time_start = $time_start;
    }

    /**
     * @return mixed
     */
    public function getTimeEnd()
    {
        return $this->time_end;
    }

    /**
     * @param mixed $time_end
     */
    public function setTimeEnd($time_end)
    {
        $this->time_end = $time_end;
    }

    /**
     * @return mixed
     */
    public function getLocalName()
    {
        return $this->local_name;
    }

    /**
     * @param mixed $local_name
     */
    public function setLocalName($local_name)
    {
        $this->local_name = $local_name;
    }

    /**
     * @return mixed
     */
    public function getLocalNumber()
    {
        return $this->local_number;
    }

    /**
     * @param mixed $local_number
     */
    public function setLocalNumber($local_number)
    {
        $this->local_number = $local_number;
    }

    /**
     * @return mixed
     */
    public function getRemoteName()
    {
        return $this->remote_name;
    }

    /**
     * @param mixed $remote_name
     */
    public function setRemoteName($remote_name)
    {
        $this->remote_name = $remote_name;
    }

    /**
     * @return mixed
     */
    public function getRemoteNumber()
    {
        return $this->remote_number;
    }

    /**
     * @param mixed $remote_number
     */
    public function setRemoteNumber($remote_number)
    {
        $this->remote_number = $remote_number;
    }

    /**
     * @return mixed
     */
    public function getDialedDigits()
    {
        return $this->dialed_digits;
    }

    /**
     * @param mixed $dialed_digits
     */
    public function setDialedDigits($dialed_digits)
    {
        $this->dialed_digits = $dialed_digits;
    }

    /**
     * @return mixed
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param mixed $direction
     */
    public function setDirection($direction)
    {
        $this->direction = (Funcs::in_arrayi ($direction, array("incoming", "in", "I")) ? "in" : "out");
    }

    /**
     * @return mixed
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param mixed $protocol
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }


    public function __construct( ) {
        $this->record = new \App\Record();

        /*
        $dynamic_enum_value = new \App\DynamicEnumValue();
        $dynamic_enum_value->save();
        $dynamic_enum_value->definition(DatabaseSeeder::$dynamic_enum)->save(DatabaseSeeder::$dynamic_enum);
        $dynamic_enum_value->value = $r[0];
        $dynamic_enum_value->value_type = \App\Enums\EnumDataSourceType::getKeyByValue('mrge');
        $dynamic_enum_value->save();
        $record->references($dynamic_enum_value);
        $record->save();
        */
    }


    public function computeRecord() {

        $this->record->type           = $this->type;
        $this->record->local_id       = $this->local_id;
        $this->record->conference_id  = $this->conference_id;
        $this->record->local_name     = $this->local_name;
        $this->record->local_number   = $this->local_number;
        $this->record->remote_name    = $this->remote_name;
        $this->record->remote_number  = $this->remote_number;
        $this->record->dialed_digits  = $this->dialed_digits;
        $this->record->direction      = $this->direction;
        $this->record->protocol       = $this->protocol;

    }

    public function computeEndpoint() {
        $this->endpoint = \App\Endpoint::getObjectById($this->endpoint_id);
        $this->record->endpoint($this->endpoint);
    }

    public function computeEntity() {
        // oh boy
        if($this->endpoint->e_many ==1 && $this->record->type == EnumDataSourceType::vidyo) {

            if($this->endpoint->name == 'portal.idvideophone.com' || $this->endpoint->ipaddress == 'portal.idvideophone.com' || $this->endpoint->ipaddress == '172.28.10.12')
                $customer_nsid = APIController::searchIdvideophone($this);
            else
                $customer_nsid = APIController::searchidsflame($this);

            if($customer_nsid) {

                Log::info($customer_nsid);
                $dev = \App\DynamicEnumValue::getByValue($customer_nsid);

                if($dev !== null) {

                    $entity= $dev->referable(\App\Entity::class);
                    $this->record->entity($entity);
                }else{
                   // $this->record->entity(null);

                }


            }

        }else{

            $this->entity = \App\Entity::getObjectById($this->endpoint->entity_id);
            $this->record->entity($this->entity);
        }

    }

    public function computeTimePeriod() {

        $timeperiod = new \App\TimePeriod();
        $timeperiod->start = $this->time_start;
        $timeperiod->end = $this->time_end;
        $timeperiod->save();
        $timeperiod->setDuration();
        $this->record->timeperiod($timeperiod);
    }

    public function computeLocation() {

        $ip2location = \App\Ip2Location::getByIp($this->remote_number);

        if ($ip2location !== false && $ip2location->latitude !== 0.0 && $ip2location->longitude !== 0.0) {

                $coordinate = new \App\Coordinate();
                $coordinate->lng = $ip2location->longitude;
                $coordinate->lat = $ip2location->latitude;
                $coordinate->save();
                $location = new \App\Location();
                $location->save();
                $location->address = null;
                $location->city = $ip2location->city_name;
                $location->state = $ip2location->region_name;
                $location->zipcode = $ip2location->zip_code;
                $location->country_code = $ip2location->country_code;
                $location->time_zone = $ip2location->time_zone;
                $location->coordinate($coordinate)->save($coordinate);
                $location->save();
                $this->record->remote_location($location)->save($location);

        } else {
            $coordinate = new \App\Coordinate();
            $coordinate->save();
            $location = new \App\Location();
            $location->save();
            $this->record->remote_location($location)->save($location);

          //  $this->record->remote_location($this->endpoint->location)->save($this->endpoint->location);
        }

    }

    public function save() {
        $this->save();
    }

    public function saveRecord() {
        $this->record->save();
    //    $this->record->process(); // for analytics (giving errors)
    }

    public function computeAll() {
        $this->computeRecord();
        $this->computeEndpoint();
        $this->computeEntity();
        $this->computeTimePeriod();
        $this->computeLocation();
        $this->saveRecord();

        return $this->record;
    }


}