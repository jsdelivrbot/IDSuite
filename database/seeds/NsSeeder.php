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
    public function run(){
        $file_name = 'ns_customerrow.csv';

        $csv = file_get_contents("$file_name");

        $companies = array_map("str_getcsv", explode("\n", $csv));
        $count = 0;
        foreach ($companies as $c){
            if($count === 0){
                $count++;
                continue;
            }

            $email = new \App\Email();

            if (filter_var($c[2], FILTER_VALIDATE_EMAIL)) {
                $email->setEmail($c[3]);
            } else {
                continue;
            }

            $name = new \App\PersonName();

            $name->preferred_name = $c[1];

            $name->save();

            $location = new \App\Location();

            $location->address = $c[3];
            $location->city = $c[5];
            $location->state = $c[6];
            $location->zipcode = $c[7];

            $location->save();

            $location->createCoordinates();

            $contact = new \App\Contact();

            $contact->location_id = $location->id;
            $contact->personname_id = $name->id;
            $contact->email_id = $email->id;

            $contact->save();

            $customer = new \App\Customer();

            $customer->contact_id = $contact->id;
            $customer->setPassword('ids_14701');
            $customer->email_address = $email->address;
            $customer->save();

        }
    }
}