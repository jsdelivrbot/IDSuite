<?php

namespace App\Http\Controllers\Netsuite;
use Illuminate\Support\Facades\Log;

use App\Analytic;
use App\Http\Controllers\Helper\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NetSuite\NetSuiteService;

/*
 * Netsuite operators: contains, doesNotContain, doesNotStartWith, empty, hasKeywords, is, isNot, notEmpty, within, noneOf
 * */
class NetsuiteDatabase extends \App\Http\Controllers\Controller
{

    /* grab all customers from netsuite and add or update current customer in database */
    public static function AddUpdateAllCustomers() {

        // grab db customers (entities)


        /*
         * todo: create entity_user table connection to connect multiple of entities to multiple user(s)
         *
         * */

        $query = "SELECT * FROM entity WHERE entity.active =1";


        dd("all local customers fetched");

        $service = new NetsuiteController();
        $result = $service->getAllCustomers(100);
        $total_pages = $result->totalPages;
        $all_records = $result->recordList->record;
        $search_id =    $result->searchId;

        // if we have more than one page
        for($page_counter = 0; $page_counter < $total_pages; $page_counter++) {
            $next_page_to_fetch = $page_counter+2;
            $search_result = $service->getPage($search_id, $next_page_to_fetch);
            $all_records = array_merge($all_records, $search_result->recordList->record);



         //   dd($all_records);
        }


        // now we have all customer records, lets start processing them






    }

    /* grab all employees from netsuite and add or update current employee list in database in one go */
    public static function AddUpdateAllEmployees() {

        // grab local employee list
        $query = "select user.id as user_id ,  dynamic_enum_value.id as dynamic_enum_value_id, dynamic_enum_value.value, dynamic_enum_value.value_type
        from user
        LEFT  JOIN object_dev ON user.id = object_dev.object_id
        LEFT  JOIN dynamic_enum_value ON object_dev.dynamic_enum_value_id = dynamic_enum_value.id
        WHERE dynamic_enum_value.value_type = 0 AND dynamic_enum_value.value IS NOT NULL";

        $local_netsuite_employee = DB::select($query);


        // get netsuite employee list
        $service = new NetsuiteController();
        $netsuite_employee_list = $service->getEmployeeList();

        $records = $netsuite_employee_list->recordList->record;


        $internal_ids = array_column($local_netsuite_employee, 'value');


        $users_created = array();
        foreach ($records as $record) {


            if(array_search($record->internalId, $internal_ids) === false) {
                //insert to database if employee not found


                $user_email = \App\User::getUserByEmail($record->email);

                // just an extra check for the email
                if (!is_object($user_email)) {

                    $email = Process::processEmail($record->email);

                    if($email) {
                    $name = Process::processName($record->firstName,$record->middleName,$record->lastName, $record->title);

                    $phone_numbers = array(
                        'default' => $record->phone,
                        'fax' => $record->fax,
                        'officePhone' => $record->officePhone,
                        'homePhone' => $record->homePhone,

                    );

                    $location = Process::processLocation(); // will create coordiante object as well



                    $phones = Process::processPhone($phone_numbers); // returns an array of PhoneNumber class


                    $dynamic_enum = \App\DynamicEnum::getByName('reference_key'); // grabbing the dynamic enum object that has name reference_key

                    $dynamic_enum_value = Process::processDev($record->internalId, 'netsuite', $dynamic_enum);

                    $person_contact = Process::processContact($location, $name, $email, $phones);

                    $user = Process::processUser($person_contact, $dynamic_enum_value);


                    $users_created[] = $user;
                    }else{
                        // invalid email! what netsuite. seriously?
                        Log::error("Invalid email", array("record" =>$record));

                    }
                    /*
                     *
                     *  $note = Process::processNote();

                    $company_name = $c[0];

                    $iscolon_index = strpos($company_name, ':');

                    if(!$iscolon_index){
                        $entity = Process::processEntity($c, $entity_contact, $note);
                    } else {

                        $entity = Process::processEntity($c, $entity_contact, $note);

                        $company_name = substr($company_name, 0, $iscolon_index);

                        $parent_entity = \App\Entity::getByName($company_name);

                        if($parent_entity === null){
                        } else {

                            $parent_entity->children($entity)->save($entity);

                            $parent_entity->save();
                        }

                    }
    */


                    //end of insert


                }else{
                    // ns record exist and email also exist.. update proccess

                    echo 'ns record exist and email also exist.. update proccess';
                }


            }else {
                // ns record found in database
                echo 'ns record found in database';
            }



        }
        echo "users created";
        dd($users_created);

    }

    /* grab customers in db and select last x not modified and grab and update sales team */
    public static function AddUpdateSalesTeam($limit = 100) {


        $dev = new DynamicEnumValue();

        $dev->value = "SC_12312";

        $de = DynamicEnum::getByName('reference_key');

        $dev->value_type = \App\Enums\EnumDataSourceType::getKeyByValue('netsuite');

        $query = "SELECT ";

        $query_result = DB::select($query);

        $service = new NetsuiteController();

        $service->getCustomer();
    }





}