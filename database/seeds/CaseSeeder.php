<?php
use Illuminate\Database\Seeder;
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 7/12/17
 * Time: 9:10 AM
 */
class CaseSeeder extends Seeder
{
    public function run(){

        $this->processCases();

    }


    public function processCases(){

        $file_name = 'case.csv';

        $csv = file_get_contents($file_name);

        $tickets = array_map("str_getcsv", explode("\n", $csv));

        $count = 0;

        foreach ($tickets as $t) {

            $progress = round(100 * ($count / count($tickets)));

            if ($progress > 0 && $progress < 10) {
                echo "Tickets : [*---------]  $progress% \r";
            } elseif ($progress > 10 && $progress < 20) {
                echo "Tickets : [**--------]  $progress% \r";
            } elseif ($progress > 20 && $progress < 30) {
                echo "Tickets : [***-------]  $progress% \r";
            } elseif ($progress > 30 && $progress < 40) {
                echo "Tickets : [****------]  $progress% \r";
            } elseif ($progress > 40 && $progress < 50) {
                echo "Tickets : [*****-----]  $progress% \r";
            } elseif ($progress > 50 && $progress < 60) {
                echo "Tickets : [******----]  $progress% \r";
            } elseif ($progress > 60 && $progress < 70) {
                echo "Tickets : [*******---]  $progress% \r";
            } elseif ($progress > 70 && $progress < 80) {
                echo "Tickets : [********--]  $progress% \r";
            } elseif ($progress > 80 && $progress < 90) {
                echo "Tickets : [*********-]  $progress% \r";
            } elseif ($progress > 90 && $progress < 100) {
                echo "Tickets : [**********]  $progress% \r";
            }


            if($t[0] === null || $count === 0){
                $count++;
                continue;
            }

            $ticket = new \App\Ticket();

            $entity = self::processEntity($t);

            if(!$entity){
                $ticket->known = false;
            } else {
                $ticket->entity($entity)->save($entity);
                $ticket->known = true;
            }

            $orgin_type = \App\Enums\EnumOriginType::getKeyByValue($t[2]);

            if($orgin_type === 0){
                file_put_contents('unknown_types.csv', '$orgin_type : ' . $t[2] . PHP_EOL, FILE_APPEND);
            }

            $ticket->origin_type = $orgin_type;

            $ticket_type = \App\Enums\EnumTicketType::getKeyByValue($t[3]);

            if($ticket_type === 0){
                file_put_contents('unknown_types.csv', '$ticket_type : ' . $t[3] . PHP_EOL, FILE_APPEND);
            }

            $ticket->ticket_type = $ticket_type;

            $priority_type = \App\Enums\EnumPriorityType::getKeyByValue($t[4]);

            if($priority_type === 0){
                file_put_contents('unknown_types.csv', '$priority_type : ' . $t[4] . PHP_EOL, FILE_APPEND);
            }

            $ticket->priority_type = $priority_type;

            $status_type = \App\Enums\EnumTicketStatusType::getKeyByValue($t[10]);

            if($status_type === 0){
                file_put_contents('unknown_types.csv', '$status_type : ' . $t[10] . PHP_EOL, FILE_APPEND);
            }

            $ticket->status_type = $status_type;

            $subject = $t[5];

            $ticket->subject = $subject;

            $incident_date = new DateTime($t[6]);

            $ticket->incident_date = $incident_date;

            $last_message_date = new DateTime($t[7]);

            $ticket->last_message_date = $last_message_date;

            $user = self::processUser($t);

            if(is_object($user)) {
                $ticket->assigned_user($user)->save($user);
            }

            $reference_id = $t[0];

            $ticket->reference_id = $reference_id;

            $ticket->save();

            $count++;
        }
    }


    public static function processUserName($user_name){
        $name = new \App\PersonName();

        $split = explode(' ', $user_name);

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
     * validate email lol does the same as above just more semantics
     *
     * @param $user_email
     * @return bool
     */
    public static function isPersonEmailValid($user_email){
        $email = \App\Email::getEmailByAddress($user_email);

        if( $email === "" || $email === null || $user_email === null || $user_email === ""){
            return false;
        }

        return true;

    }


    /**
     *
     * Process User Email
     *
     * creates a user email.
     *
     * @param $user_email
     * @return \App\Email
     */
    public static function processUserEmail($user_email){

        $isvalidemail = self::isPersonEmailValid($user_email);

        if ($isvalidemail) {

            $email = \App\Email::getEmailByAddress($user_email);
            $email->save();

        } else {

            $email = new \App\Email();

            if(!$email->setEmail($user_email)){
                $email->save();
            }
        }

        return $email;
    }


    /**
     *
     * Default User Phone Number
     *
     * creates default IDS phone number instance
     *
     */
    public static function defaultUserPhoneNumber(){
        $number = new \App\PhoneNumber();

        $number->number = '877-774-3526';

        $number->save();

        return $number;
    }

    /**
     *
     * default user location
     *
     * @return \App\Location
     */
    public static function defaultUserLocation()
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
     * Process User Contact
     *
     * Create user contact.
     *
     *
     * @param \App\PersonName $name
     * @param \App\Email $email
     * @param \App\PhoneNumber $phone
     * @param \App\Location $location
     * @return \App\PersonContact
     */
    public static function processUserContact(\App\PersonName $name, \App\Email $email, \App\PhoneNumber $phone, \App\Location $location){

        $contact = new \App\PersonContact();

        $contact->name($name)->save($name);
        $contact->email($email)->save($email);
        $contact->phonenumber($phone)->save($phone);
        $contact->location($location)->save($location);

        $contact->save();

        return $contact;
    }



    /**
     *
     * Process User
     *
     * It takes a NS case record and returns false if the user cannot be created or doesn't exist. If it does exist it
     * returns a User.
     *
     * @param $t
     * @return null
     */
    public static function processUser($t){

        $user_name = $t[9];

        $user_email = $t[14];

        if($user_name === "" || $user_email === ""){
            return null;
        }

        $user = \App\User::getUserByEmail($user_email);

        if(is_object($user)){
            return $user;
        }

        $name = self::processUserName($user_name);
        $email = self::processUserEmail($user_email);
        $phone = self::defaultUserPhoneNumber();
        $location = self::defaultUserLocation();

        $contact = self::processUserContact($name, $email, $phone, $location);

        $user = new \App\User();

        $user->save();

        $user->contact($contact)->save($contact);

        $user->email_address = $email->address;
        $user->getEmailUsername();
        $user->setPassword('ids_14701');

        $user->save();

        return $user;
    }


    /**
     *
     * Process Entity
     *
     * It takes a NS case record and returns false if the entity cannot be created or doesn't exist. If it does exist it
     * returns a Entity.
     *
     * @param $t
     * @return bool
     */
    public static function processEntity($t){

        $entity_name = $t[1];

        if($t[1] === ""){
            return false;
        }

        $iscolon_index = strpos($entity_name, ':');

        if(!$iscolon_index){

            $entity = \App\Entity::getByName($t[0]);

            if($entity === null) {

                return false;

            } else {

                return $entity;

            }

        } else {
            $entity_name = substr($entity_name, 0, $iscolon_index - 1);

            $entity = \App\Entity::getByName($entity_name);

            if($entity === null) {

                return false;

            } else {

                return $entity;

            }

        }

    }

}