<?php

namespace App\Http\Controllers\Netsuite;

use App\DynamicEnumValue;
use App\Enums\EnumDataSourceType;
use App\Http\Controllers\Helper\Database;
use App\Http\Controllers\Helper\Funcs;
use Illuminate\Support\Facades\Log;
use App\Analytic;
use App\Http\Controllers\Helper\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use NetSuite\NetSuiteService;
use Symfony\Component\VarDumper\Cloner\Data;

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

        // grab all customers that have a netsuite id

        // grab local employee list

        $local_netsuite_employee = Database::getAllCustomers();
        $internal_ids = array_column($local_netsuite_employee, 'value');


     //   dd("all local customers fetched");

        $service = new NetsuiteController();
        $result = $service->getAllCustomers(50);
        echo ".";
        $total_pages = $result->totalPages;
        $all_records = $result->recordList->record;
        $search_id =    $result->searchId;


        // if we have more than one page
      //  goto skip_pages;
        for($page_counter = 0; $page_counter < $total_pages; $page_counter++) {

            $next_page_to_fetch = $page_counter+2;

            $search_result = [];
            $retry = 10;
            do{

                try{
                    $search_result = $service->getPage($search_id, $next_page_to_fetch);
                    $retry = 0; // it was able to continue
                }catch (\Exception $e) {
                    echo "%"; // retry
                    sleep(2); // give me a second will you
                    $retry--;
                }

            }while($retry != 0);

            if($search_result && is_array($search_result->recordList->record)){
                $all_records = array_merge($all_records, $search_result->recordList->record);
                echo "."; // merged
            }
            else
                echo "_"; // skipped
            //
         //   dd($all_records);
        }
     //   skip_pages:


        $insert_counter = 1;
        // now we have all customer records, lets start processing them
        foreach ($all_records as $record) {
            echo $insert_counter."/".count($all_records)."...";
            $insert_counter ++;
            // match customers by internal id
            if(array_search($record->internalId, $internal_ids) === false) {

                // add customer
                $phone_numbers = array(
                    'default' => $record->phone,
                    'fax' => $record->fax

                );

                $location = Process::processLocation(); // will create coordiante object as well
                $name = Process::processEntityName($record->companyName);
                $phones = Process::processPhone($phone_numbers); // returns an array of PhoneNumber class
                $email = Process::processEmail($record->email);
                $entity_contact = Process::processEntityContact($location, $name, $email, $phones);

                $note = Process::processNote($record->comments);
                $dynamic_enum = \App\DynamicEnum::getByName('reference_key'); // grabbing the dynamic enum object that has name reference_key
                $dynamic_enum_value = Process::processDev($record->internalId, 'netsuite', $dynamic_enum);
                $entity = Process::processEntity($entity_contact, $dynamic_enum_value, $note);


                // fix parent
                if($record->parent !== null) {
                    $parent_netsuite_id = $record->parent->internalId;
                    $dev = DynamicEnumValue::getByValue($parent_netsuite_id, EnumDataSourceType::getKeyByValue("netsuite"));

                    if(!$dev) {
                        $parent_entity = $dev->referable(\App\Entity::class);
                        $parent_entity->children($entity)->save($entity);
                        $parent_entity->save();
                    }
                }


                // add person contacts
                $contactRolesList = $record->contactRolesList;
                if($contactRolesList !== null) {
                    //add contacts

                    $contactRoles = $contactRolesList->contactRoles;
                    foreach ($contactRoles as $contactRole) {

                        $internal_id = $contactRole->contact->internalId;
                        $name = $contactRole->contact->name;
                        $name = Funcs::split_name($name);
                        $name = Process::processName($name[0],null, $name[1], null);

                        $location = Process::processLocation();
                        $email = Process::processEmail($contactRole->email);

                        Process::processContact( $location, $name, $email,  [], $entity);
                    }
                }
                // end of adding contacts to customer

                // attach employee to customer

                if($record->salesRep != null) {
                    $sales_rep_netsuite_id = $record->salesRep->internalId;
                    if($sales_rep_netsuite_id) {

                        // look for netsuite id in database
                        $dev = DynamicEnumValue::getByValue($sales_rep_netsuite_id, EnumDataSourceType::getKeyByValue("netsuite"));
                        if($dev) {
                            $user = $dev->referable(\App\User::class);


                            $entity->user($user);
                            $entity->save();
                        }

                    }else {

                        echo ("no emp found for ".$sales_rep_netsuite_id);
                        //no employee found to attach this customer to
                    }
                }


            }else {
                // ns record found in database.
                //todo: update user in database
                echo 'ns record '.($record->internalId).'found in database';
            }
        }

    }

    /* grab all employees from netsuite and add or update current employee list in database in one go */
    public static function AddUpdateAllEmployees() {




        // get netsuite employee list
        $service = new NetsuiteController();
        $netsuite_employee_list = $service->getEmployeeList();

        $records = $netsuite_employee_list->recordList->record;

        $local_netsuite_employee = Database::getAllEmployees();

        $internal_ids = array_column($local_netsuite_employee, 'value');


        $users_created = array();
        foreach ($records as $record) {


            if(array_search($record->internalId, $internal_ids) === false) {
                //insert to database if employee not found


                $user_email = \App\User::getUserByEmail($record->email);

                // just an extra check for the email
                if (!is_object($user_email)) {

                    $email = Process::processEmail($record->email, true);

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

                        $person_contact = Process::processContact( $location, $name, $email, $phones);

                        $user = Process::processUser($person_contact, $dynamic_enum_value);


                        $users_created[] = $user;
                    }else{
                        // invalid email! what netsuite. seriously?
                        Log::error("Invalid email", array("record" =>$record));

                    }



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