<?php

namespace App\Http\Controllers\Helper;


use App\DynamicEnumValue;
use Illuminate\Support\Facades\App;

class Process {


    /**
     *
     * Process entity email
     *
     *
     * @param $c
     * @return \App\Email
     */

    public static function processEmail($email_r=null, $return_false = false)
    {
        $isvalidemail = Validation::isEmailValid($email_r);

        if ($isvalidemail) {
            $email = new \App\Email();
            $email->setEmail($email_r);
        } else {
            return $return_false;
          //  throw new \Exception('invalid email inside processEmail '.$email_r, 500);

        }

        return $email;
    }

    /**
     *
     * process user email
     *
     * @param $user
     * @return \App\Email
     */
    public static function processUserEmail($user)
    {
        $isvalidemail = self::isPersonEmailValid($user[1]);

        if ($isvalidemail) {
            $email = \App\Email::getEmailByAddress($user[1]);
            $email->save();
        } else {
            $email = new \App\Email();
            if(!$email->setEmail($user[1])){
                $email->save();
            }
        }

        return $email;
    }

    /**
     *
     * process entity name
     *
     *
     * @param null $first_name
     * @param null $middle_name
     * @param null $last_name
     * @param null $title
     * @return \App\PersonName
     */
    public static function processName($first_name=null, $middle_name=null, $last_name=null, $title=null)
    {
        $name = new \App\PersonName();
        $name->first_name = $first_name;
        $name->middle_name = $middle_name;
        $name->last_name = $last_name;
        $name->preferred_name = $first_name;
        $name->title = $title; // programmer

        $name->save();

        return $name;

    }

    /**
     *
     * process Person Name
     *
     * @param $c
     * @return \App\PersonName
     */
    public static function processUserName($user)
    {

        $name = new \App\PersonName();

        $split = explode(' ', $user[0]);

        $firstname = $split[0];
        $middle_name = null;
        $last_name = null;
        $preferred_name = null;

        if(count($split) === 2){
            $middle_name = null;
            $last_name = $split[1];
            $preferred_name = $firstname;
        } elseif(count($split) > 2){
            $middle_name = $split[1];
            $last_name = $split[2];
            $preferred_name = $firstname;
        }

        if($user[3] !== ""){
            $title = $user[3];
        } else {
            $title = null;
        }


        if($firstname !== "") {
            $name->first_name = $firstname;
        } else {
            $name->first_name = null;
        }
        $name->middle_name = $middle_name;
        $name->last_name = $last_name;
        $name->preferred_name = $preferred_name;
        $name->title = $title;


        $name->save();

        return $name;
    }

    /**
     *
     * process location
     *
     * @param null $address
     * @param null $city
     * @param null $state
     * @param null $zipcode
     * @param \App\Coordinate|null $coors
     * @return \App\Location
     * @internal param $c
     */
    public static function processLocation($address=null, $city=null, $state=null, $zipcode=null, $country = null, \App\Coordinate $coors=null)
    {
        $location = new \App\Location();

        $location->address = $address;
        $location->city = $city;
        $location->state = $state;
        $location->zipcode = $zipcode;
        $location->country_code = $country;
        $location->save();

        if($coors == null) {
            $coors = Process::processCoordinate();
            $location->coordinate($coors)->save($coors);


        }else {
            $location->coordinate($coors)->save($coors);
        }
        $location->save();
        return $location;

    }

    /**
     *
     * process user location
     *
     * @return \App\Location
     */
    public static function processUserLocation()
    {
        $location = new \App\Location();

        $location->address = '14701 Cumberland Road';
        $location->city = 'Noblesville';
        $location->state = 'Indiana';
        $location->zipcode = '46060';

        $location->save();

        return $location;

    }

    /**
     *
     * process phone number
     *
     * @param $c
     * @return \App\PhoneNumber[]
     */
    public static function processPhone($phone_number=null, $default_type=null)
    {
        $saved_phone_nums = [];
        $phone = null; // initialize
            if(is_array($phone_number)) {

                foreach ($phone_number as $type=>$phone_num) {
                    if($phone_num){

                        $phone = new \App\PhoneNumber($phone_num, $type);
                        $phone->save();
                        $saved_phone_nums[]=$phone;
                    }
                }
                if(empty($saved_phone_nums)){
                    $phone = new \App\PhoneNumber();
                    $phone->save();

                }
            }else{
                // looks like its just a number

                if($phone_number) {
                    $phone = new \App\PhoneNumber($phone_number, $default_type);
                    $phone->save();
                } else {
                    $phone = new \App\PhoneNumber();
                    $phone->save();
                }
                $saved_phone_nums[] = $phone;
            }

        return $saved_phone_nums;

    }


    /**
     *
     * process user phone number
     *
     * @param $c
     * @return \App\PhoneNumber
     */
    public static function processUserPhone($c)
    {
        $phone = new \App\PhoneNumber('3177703500');
        $phone->save();

        return $phone;
    }


    /**
     * @param \App\Location $location
     * @param \App\PersonName $name
     * @param \App\Email $email
     * @param $phones array
     * @param \App\Website $website
     * @return \App\PersonContact
     */
    public static function processContact(\App\Location $location, \App\PersonName $name, \App\Email $email, array $phones)
    {
        $person_contact = new \App\PersonContact();

        $person_contact->location($location)->save($location);
        $person_contact->name($name)->save($name);
        $person_contact->email($email)->save($email);

        foreach ($phones as $phone) {
            $person_contact->phonenumber($phone)->save($phone);
        }

        $person_contact->save();

        return $person_contact;
    }


    public static function processWebsite($url=null) {


        $validate_website = Validation::isUrlValid($url);

        if(!$validate_website) {
            $url = null;

        }
        $website = new \App\Website();
        $website->setWebsite($url);
        $website->save();

        return $website;

    }

    /**
     *
     * process user contact
     *
     * @param $c
     * @param \App\Location $location
     * @param \App\PersonName $name
     * @param \App\Email $email
     * @param \App\PhoneNumber $phone
     * @return \App\PersonContact
     */
    public static function processUserContact($c, \App\Location $location, \App\PersonName $name, \App\Email $email, \App\PhoneNumber $phone)
    {
        $user_contact = new \App\PersonContact();

        $user_contact->location($location)->save($location);
        $user_contact->name($name)->save($name);
        $user_contact->email($email)->save($email);
        $user_contact->phonenumber($phone)->save($phone);

        $user_contact->save();
        return $user_contact;
    }


    /**
     *
     * process note for entity
     *
     * @param $c
     * @return \App\Note
     */
    public static function processNote($raw_note)
    {

        if(!empty($raw_note)){
            $note = new \App\Note();

            $note->text = $raw_note;

            $note->save();
        } else {
            $note = null;
        }

        return $note;

    }

    /**
     *
     * process entity
     *
     * @param $c
     * @param \App\EntityContact $entity_contact
     * @return \App\Entity
     */
    public static function processEntity($c, \App\EntityContact $entity_contact, $note)
    {
        $entity = new \App\Entity();

        $entity->save();

        $entity->contact($entity_contact)->save($entity_contact);

        $entity->save();

        if($note !== null){
            $entity->notes()->save($note);
        }

        $dynamic_enum_value = new \App\DynamicEnumValue();

        $dynamic_enum_value->save();

        $dynamic_enum = \App\DynamicEnum::getByName('reference_key');

        $dynamic_enum_value->definition($dynamic_enum)->save($dynamic_enum);

        $dynamic_enum_value->value = $c[10];

        $dynamic_enum_value->value_type = \App\Enums\EnumDataSourceType::getKeyByValue('netsuite');

        $dynamic_enum_value->save();

        $entity->references($dynamic_enum_value);

        $entity->save();

        return $entity;
    }


    /**
     * @param \App\PersonContact $entity_contact
     * @return \App\User
     */
    public static function processUser(\App\PersonContact $person_contact, \App\DynamicEnumValue $dynamic_enum_value)
    {

        $user = new \App\User();
        $user->save();
        $user->contact($person_contact)->save($person_contact);
        $user->email_address = $person_contact->email->address;

        $user->references($dynamic_enum_value);

        $user->setPassword('ids_14701');
        $user->save();

        return $user;


    }


    /**
     * @param $value
     * @param $type
     * @param $dynamic_enum
     * @return DynamicEnumValue
     * @throws \Exception
     * @internal param DynamicEnumValue $dynamic_enum_value
     */
    public static function processDev($value, $type, $dynamic_enum) {

        $isvalidtype = \App\Enums\EnumDataSourceType::getKeyByValue($type);

        if($isvalidtype !== false){
            $dev = new DynamicEnumValue();

            $dev->value_type = \App\Enums\EnumDataSourceType::getKeyByValue($type);

            $dev->value = $value;

            $dev->definition($dynamic_enum)->save($dynamic_enum);

            $dev->save();
        } else {
            throw new \Exception('The type must be valid value in EnumDataSourceType. The type that you are attempting to create with is ' . $type, 500);
        }

        return $dev;

    }


    /**
     *
     * Process Sites is used to process the EntityContact used to indicate one of possibly many sites associated with an Entity
     *
     * @param array $c
     * @return bool
     */
    public static function processSite($c)
    {
        $parent_entity = \App\Entity::getByName($c[5]);

        if (is_object($parent_entity)) {
            $email = self::processEmail($c);

            $name = self::processName($c);

            $location = self::processLocation($c);

            //$location->createCoordinates();

            $phone = self::processPhone($c);

            $entity_contact = self::processContact($c, $location, $name, $email, $phone);

            $parent_entity->sites($entity_contact)->save($entity_contact);

            $parent_entity->save();

            $entity = \App\Entity::getObjectById($parent_entity->id);

            $parent_entity->save();

            return $parent_entity;
        } else {
            false;
        }

        return false;
    }

    public static function processCoordinate($lat=null, $lng=null) {
        $coors = new \App\Coordinate();
        $coors->lat = $lat;
        $coors->lng = $lng;
        $coors->save();
        return $coors;

    }
}
