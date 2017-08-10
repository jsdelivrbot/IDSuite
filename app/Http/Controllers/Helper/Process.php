<?php

namespace App\Http\Controllers\Helper;

use InvalidArgumentException;
use Illuminate\Console\Command;
use Illuminate\Container\Container;



public class Process {


    /**
     *
     * Process entity email
     *
     *
     * @param $c
     * @return \App\Email
     */
    public static function processEmail($email_r)
    {
        $isvalidemail = ($email_r);

        if ($isvalidemail) {
            $email = \App\Email::getEmailByAddress($email_r);
            $email->save();
        } else {
            $email = new \App\Email();
            $email->setEmail($email_r);
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
     * @param $c
     * @return \App\EntityName
     */
    public static function processName($c)
    {
        $company_name = $c[0];

        $iscolon_index = strpos($company_name, ':');

        if(!$iscolon_index){

            $entity_name = \App\Entity::getByName($c[0]);

            if($entity_name === null) {
                $name = new \App\EntityName();
                $name->name = $c[0];
                $name->save();
            } else {
                $name = $entity_name->contact->name;
            }
        } else {
            $company_name = substr($company_name, $iscolon_index + 2, strlen($company_name));

            $entity_name = \App\Entity::getByName($company_name);

            if($entity_name === null) {
                $name = new \App\EntityName();
                $name->name = $company_name;
                $name->save();
            } else {
                $name = $entity_name->contact->name;
            }
        }


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
     * @param $c
     * @return \App\Location
     */
    public static function processLocation($address=null, $city=null, $state=null, $zipcode=null)
    {
        $location = new \App\Location();

        $location->address = $address;
        $location->city = $city;
        $location->state = $state;
        $location->zipcode = $zipcode;
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
     *
     * process entity contact
     *
     *
     * @param $c
     * @param \App\Location $location
     * @param \App\EntityName $name
     * @param \App\Email $email
     * @param \App\PhoneNumber $phone
     * @return \App\EntityContact
     */
    public static function processContact( \App\Location $location, \App\EntityName $name, \App\Email $email, \App\PhoneNumber $phones, \App\Website $website)
    {
        $entity_contact = new \App\EntityContact();

        $entity_contact->location($location)->save($location);
        $entity_contact->name($name)->save($name);
        $entity_contact->email($email)->save($email);

        foreach ($phones as $phone) {
            $entity_contact->phonenumber($phone)->save($phone);
        }

        $entity_contact->website($website);
        $entity_contact->save();

        return $entity_contact;
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
     *
     * Process User
     *
     * Create a User class object given a row of Entity data and Entity
     *
     * @param $c
     * @param \App\Entity $entity
     * @return \App\User|bool
     */
    public static function processUser($c, $entity)
    {
        $ns_user = self::getUser($c[8]);

        if($ns_user !== false) {
            $user = \App\User::getUserByEmail($ns_user[1]);

            if (is_object($user)) {

                if ($entity === null) {

                } else {

                    $user->accounts($entity)->save($entity);
                    $user->save();

                    return $user;
                }
            } else {

                $email = self::processUserEmail($ns_user);

                if ($email->address === "") {
                    $email->address = null;
                    return false;
                }

                $name = self::processUserName($ns_user);

                $location = self::processUserLocation();

                $phone = self::processUserPhone($c);

                $contact = self::processUserContact($c, $location, $name, $email, $phone);

                $user = new \App\User();

                $user->save();

                $user->contact($contact)->save($contact);

                $user->email_address = $email->address;

                $user->getEmailUsername();
                $user->setPassword('ids_14701');

                $user->accounts($entity)->save($entity);

                $user->save();

                return $user;
            }
        }

        return false;

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
}

