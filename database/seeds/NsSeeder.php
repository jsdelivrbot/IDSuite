<?php
use Illuminate\Database\Seeder;
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/14/17
 * Time: 4:56 PM
 */
class NsSeeder extends Seeder
{
    public function run()
    {
        $file_name = 'ns_customerrow.csv';

        $csv = file_get_contents("$file_name");


        $companies = array_map("str_getcsv", explode("\n", $csv));


        $count = 1;


        foreach ($companies as $c) {

            $progress = round(100 * ($count / count($companies)));

            if ($progress > 0 && $progress < 10) {
                echo "First Pass : [*---------]  $progress% \r";
            } elseif ($progress > 10 && $progress < 20) {
                echo "First Pass : [**--------]  $progress% \r";
            } elseif ($progress > 20 && $progress < 30) {
                echo "First Pass : [***-------]  $progress% \r";
            } elseif ($progress > 30 && $progress < 40) {
                echo "First Pass : [****------]  $progress% \r";
            } elseif ($progress > 40 && $progress < 50) {
                echo "First Pass : [*****-----]  $progress% \r";
            } elseif ($progress > 50 && $progress < 60) {
                echo "First Pass : [******----]  $progress% \r";
            } elseif ($progress > 60 && $progress < 70) {
                echo "First Pass : [*******---]  $progress% \r";
            } elseif ($progress > 70 && $progress < 80) {
                echo "First Pass : [********--]  $progress% \r";
            } elseif ($progress > 80 && $progress < 90) {
                echo "First Pass : [*********-]  $progress% \r";
            } elseif ($progress > 90 && $progress < 100) {
                echo "First Pass : [**********]  $progress% \r";
            }

            if ($c[0] === null) {
                $count++;
                continue;
            }
            $count++;

            if ($c[5] === '' && $c[15] === 'No' && $c[2] !== '') {
                $results = self::processRowIntoEntity($c);
                if(!$results){
                    continue;
                }
            } else {
                continue;
            }
        }

        $count = 1;

        foreach ($companies as $c) {

            $progress = round(100 * ($count / count($companies)));

            if ($progress > 0 && $progress < 10) {
                echo "Second Pass : [*---------]  $progress% \r";
            } elseif ($progress > 10 && $progress < 20) {
                echo "Second Pass : [**--------]  $progress% \r";
            } elseif ($progress > 20 && $progress < 30) {
                echo "Second Pass : [***-------]  $progress% \r";
            } elseif ($progress > 30 && $progress < 40) {
                echo "Second Pass : [****------]  $progress% \r";
            } elseif ($progress > 40 && $progress < 50) {
                echo "Second Pass : [*****-----]  $progress% \r";
            } elseif ($progress > 50 && $progress < 60) {
                echo "Second Pass : [******----]  $progress% \r";
            } elseif ($progress > 60 && $progress < 70) {
                echo "Second Pass : [*******---]  $progress% \r";
            } elseif ($progress > 70 && $progress < 80) {
                echo "Second Pass : [********--]  $progress% \r";
            } elseif ($progress > 80 && $progress < 90) {
                echo "Second Pass : [*********-]  $progress% \r";
            } elseif ($progress > 90 && $progress < 100) {
                echo "Second Pass : [**********]  $progress% \r";
            }


            if ($c[0] === null) {
                $count++;
                continue;
            }
            $count++;

            if ($c[5] !== "") {
                $results = self::processSite($c);
                if(!$results){
                    continue;
                }
            } else {
                continue;
            }
        }
    }

    public static function isEmailValid($c)
    {
        $email = \App\Email::getEmailByAddress($c[3]);

        if( $email === "" || $email === null || $c[3] === null || $c[3] === ""){
            return false;
        }

        return true;

    }


    public static function isPersonEmailValid($c)
    {
        $email = \App\Email::getEmailByAddress($c[13]);

        if( $email === "" || $email === null || $c[13] === null || $c[13] === ""){
            return false;
        }

        return true;

    }

    public static function processEmail($c)
    {
        $isvalidemail = self::isEmailValid($c);

        if ($isvalidemail) {
            $email = \App\Email::getEmailByAddress($c[3]);
            $email->save();
        } else {
            $email = new \App\Email();
            if(!$email->setEmail($c[3])){
                $email->save();
            }
        }

        return $email;
    }

    public static function processUserEmail($c)
    {
        $isvalidemail = self::isPersonEmailValid($c);

        if ($isvalidemail) {
            $email = \App\Email::getEmailByAddress($c[13]);
            $email->save();
        } else {
            $email = new \App\Email();
            if(!$email->setEmail($c[13])){
                $email->save();
            }
        }

        return $email;
    }

    public static function processName($c)
    {

        $name = new \App\EntityName();

        $name->name = $c[2];

        $name->save();

        return $name;
    }

    public static function processUserName($c)
    {

        $name = new \App\PersonName();

        $split = explode(' ', $c[11]);

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


        $name->first_name = $firstname;
        $name->middle_name = $middle_name;
        $name->last_name = $last_name;
        $name->preferred_name = $preferred_name;

        $name->save();

        return $name;
    }

    public static function processLocation($c)
    {
        $location = new \App\Location();

        if ($c[7] !== "") {
            $location->address = $c[7];
        } else {
            $location->address = null;
        }
        if ($c[8] !== "") {
            $location->city = $c[8];
        } else {
            $location->city = null;
        }
        if ($c[9] !== "") {
            $location->state = $c[9];
        } else {
            $location->state = null;
        }
        if ($c[10] !== "") {
            $location->zipcode = $c[10];
        } else {
            $location->zipcode = null;
        }

        $location->save();

        return $location;

    }

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

    public static function processPhone($c)
    {
        $phone = new \App\PhoneNumber();

        if ($c[6] !== "") {
            $phone->number = $c[6];
        } else {
            $phone->number = null;
        }

        $phone->save();

        return $phone;
    }


    public static function processUserPhone($c)
    {
        $phone = new \App\PhoneNumber();

        if ($c[14] !== "") {
            $phone->number = $c[14];
        } else {
            $phone->number = null;
        }

        $phone->save();

        return $phone;
    }

    public static function processContact($c, \App\Location $location, \App\EntityName $name, \App\Email $email, \App\PhoneNumber $phone)
    {
        $entity_contact = new \App\EntityContact();

        $entity_contact->location($location)->save($location);
        $entity_contact->entityname($name)->save($name);
        $entity_contact->email($email)->save($email);
        $entity_contact->phonenumber($phone)->save($phone);

        $entity_contact->save();

        return $entity_contact;
    }

    public static function processUserContact($c, \App\Location $location, \App\PersonName $name, \App\Email $email, \App\PhoneNumber $phone)
    {
        $user_contact = new \App\PersonContact();

        $user_contact->location($location)->save($location);
        $user_contact->personname($name)->save($name);
        $user_contact->email($email)->save($email);
        $user_contact->phonenumber($phone)->save($phone);

        $user_contact->save();
        return $user_contact;
    }

    public static function processEntity($c, \App\EntityContact $entity_contact)
    {
        $entity = new \App\Entity();

        $entity->save();

        $entity->contact($entity_contact)->save($entity_contact);

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
        $user = \App\User::getUserByEmail($c[13]);
        if (is_object($user)) {

            $user->accounts($entity)->save($entity);
            $user->save();

            return $user;
        } else {

            $email = self::processUserEmail($c);

            if($email->address === ""){
                $email->address = null;
                return false;
            }

            $name = self::processUserName($c);

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


    /**
     *
     * Process Row Into Entity returns an Entity that is processed from csv Entity Row data.
     *
     * @param array $c
     * @return \App\Entity
     */
    public static function processRowIntoEntity($c)
    {
        $email = self::processEmail($c);

        $name = self::processName($c);

        $location = self::processLocation($c);

        //$location->createCoordinates();

        $phone = self::processPhone($c);

        $entity_contact = self::processContact($c, $location, $name, $email, $phone);

        $entity = self::processEntity($c, $entity_contact);

        $user = self::processUser($c, $entity);

        return $entity;


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
    }
}