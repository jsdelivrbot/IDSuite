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
        $file_name = 'ns_customers.csv';

        $csv = file_get_contents("$file_name");


        $companies = array_map("str_getcsv", explode("\n", $csv));


        $count = 0;

        $progress_count = 0;

        foreach ($companies as $c) {

            $progress = round(100 * ($count / count($companies)));

            if ($progress >= 0 && $progress < 10) {
                echo "Entities : [*---------]  $progress% \r";
            } elseif ($progress >= 10 && $progress < 20) {
                echo "Entities : [**--------]  $progress% \r";
            } elseif ($progress >= 20 && $progress < 30) {
                echo "Entities : [***-------]  $progress% \r";
            } elseif ($progress >= 30 && $progress < 40) {
                echo "Entities : [****------]  $progress% \r";
            } elseif ($progress >= 40 && $progress < 50) {
                echo "Entities : [*****-----]  $progress% \r";
            } elseif ($progress >= 50 && $progress < 60) {
                echo "Entities : [******----]  $progress% \r";
            } elseif ($progress >= 60 && $progress < 70) {
                echo "Entities : [*******---]  $progress% \r";
            } elseif ($progress >= 70 && $progress < 80) {
                echo "Entities : [********--]  $progress% \r";
            } elseif ($progress >= 80 && $progress < 90) {
                echo "Entities : [*********-]  $progress% \r";
            } elseif ($progress >= 90 && $progress < 100) {
                echo "Entities : [**********]  $progress% \r";
            } else {
                if($progress_count === 0) {
                    echo "Entities : [**********]  $progress% \n";
                    $progress_count++;
                }
            }



            if($count > 0){
                if ($c[0] === null) {
                    $count++;
                } else {
                    $results = self::processRowIntoEntity($c);
                    $count++;
                }
            } else {
                $count++;
            }
        }
    }

    /**
     *
     * Validate email
     *
     * @param $c
     * @return bool
     */
    public static function isEmailValid($c)
    {
        $email = \App\Email::getEmailByAddress($c[1]);

        if( $email === "" || $email === null || $c[1] === null || $c[1] === ""){
            return false;
        }

        return true;

    }


    /**
     *
     * validate email lol does the same as above just more semantics
     *
     * @param $c
     * @return bool
     */
    public static function isPersonEmailValid($c)
    {
        $email = \App\Email::getEmailByAddress($c[10]);

        if( $email === "" || $email === null || $c[10] === null || $c[10] === ""){
            return false;
        }

        return true;

    }

    /**
     *
     * Process entity email
     *
     *
     * @param $c
     * @return \App\Email
     */
    public static function processEmail($c)
    {
        $isvalidemail = self::isEmailValid($c);


        if ($isvalidemail) {
            $email = \App\Email::getEmailByAddress($c[1]);
            $email->save();
        } else {
            $email = new \App\Email();
            $email->setEmail($c[1]);
        }

        return $email;
    }

    /**
     *
     * process user email
     *
     * @param $c
     * @return \App\Email
     */
    public static function processUserEmail($c)
    {
        $isvalidemail = self::isPersonEmailValid($c);

        if ($isvalidemail) {
            $email = \App\Email::getEmailByAddress($c[10]);
            $email->save();
        } else {
            $email = new \App\Email();
            if(!$email->setEmail($c[10])){
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
    public static function processUserName($c)
    {

        $name = new \App\PersonName();

        $split = explode(' ', $c[8]);

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

    /**
     *
     * process location
     *
     * @param $c
     * @return \App\Location
     */
    public static function processLocation($c)
    {
        $location = new \App\Location();

        if ($c[4] !== "") {
            $location->address = $c[4];
        } else {
            $location->address = null;
        }
        if ($c[5] !== "") {
            $location->city = $c[5];
        } else {
            $location->city = null;
        }
        if ($c[6] !== "") {
            $location->state = $c[6];
        } else {
            $location->state = null;
        }
        if ($c[7] !== "") {
            $location->zipcode = $c[7];
        } else {
            $location->zipcode = null;
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
     * @return \App\PhoneNumber
     */
    public static function processPhone($c)
    {
        $number = null;

        if ($c[2] !== "") {

            preg_match_all('/\d/', $c[2], $matches);

            foreach ($matches as $match){
                $number = implode("", $match);
            }

            $phone = new \App\PhoneNumber($number);

        } else {

            $phone = new \App\PhoneNumber();

        }

        $phone->save();

        return $phone;
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
    public static function processContact($c, \App\Location $location, \App\EntityName $name, \App\Email $email, \App\PhoneNumber $phone)
    {
        $entity_contact = new \App\EntityContact();

        $entity_contact->location($location)->save($location);
        $entity_contact->name($name)->save($name);
        $entity_contact->email($email)->save($email);
        $entity_contact->phonenumber($phone)->save($phone);

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
    public static function processNote($c)
    {

        if($c[9] !== ""){
            $note = new \App\Note();

            $note->text = $c[9];

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
        $user = \App\User::getUserByEmail($c[10]);
        if (is_object($user)) {

            if($entity === null) {

            } else {

                $user->accounts($entity)->save($entity);
                $user->save();

                return $user;
            }
        } else {

            if ($c[10] !== "") {

                $email = self::processUserEmail($c);

                if ($email->address === "") {
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
            } else {
            }
        }

        return false;
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

        $note = self::processNote($c);

        $company_name = $c[0];

        $iscolon_index = strpos($company_name, ':');

        if(!$iscolon_index){
            $entity = self::processEntity($c, $entity_contact, $note);
        } else {

            $entity = self::processEntity($c, $entity_contact, $note);

            $company_name = substr($company_name, 0, $iscolon_index);

            $parent_entity = \App\Entity::getByName($company_name);

            if($parent_entity === null){
                dump($company_name);
            } else {

                $parent_entity->children($entity)->save($entity);

                $parent_entity->save();
            }

        }

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

        return false;
    }
}