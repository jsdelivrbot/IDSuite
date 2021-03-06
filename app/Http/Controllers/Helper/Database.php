<?php
/**
 * Created by PhpStorm.
 * User: fbreidi
 * Date: 8/14/2017
 * Time: 7:47 PM
 */

namespace App\Http\Controllers\Helper;

use Illuminate\Support\Facades\DB;

class Database {

    // get all customers from local database that have a netsuite id (value_type = 0)
    public static function getAllEmployees() {

        // grab local employee list
        $query = "select user.id as user_id ,  dynamic_enum_value.id as dynamic_enum_value_id, dynamic_enum_value.value, dynamic_enum_value.value_type
            from user
            LEFT  JOIN object_dev ON user.id = object_dev.object_id
            LEFT  JOIN dynamic_enum_value ON object_dev.dynamic_enum_value_id = dynamic_enum_value.id
            WHERE dynamic_enum_value.value_type = 0 AND dynamic_enum_value.value IS NOT NULL";

        $local_netsuite_employee = DB::select($query);

        return $local_netsuite_employee;
    }

    public static function getAllSMSites() {
        // will also grab customer location
        $query = "select  entitycontact.id as entitycontact_id ,  dynamic_enum_value.id as dynamic_enum_value_id, dynamic_enum_value.value, dynamic_enum_value.value_type
            from entitycontact
            LEFT  JOIN object_dev ON entitycontact.id = object_dev.object_id
            LEFT  JOIN dynamic_enum_value ON object_dev.dynamic_enum_value_id = dynamic_enum_value.id
            WHERE dynamic_enum_value.value_type = 0 AND dynamic_enum_value.value IS NOT NULL";

        $local_sm_sites = DB::select($query);

        return $local_sm_sites;
    }




    // get all tickets from local database that have a netsuite id (value_type = 0)
    public static function getAllTickets() {

        // grab local employee list
        $query = "select ticket.id as ticket_id ,  dynamic_enum_value.id as dynamic_enum_value_id, dynamic_enum_value.value, dynamic_enum_value.value_type
            from ticket
            LEFT  JOIN object_dev ON ticket.id = object_dev.object_id
            LEFT  JOIN dynamic_enum_value ON object_dev.dynamic_enum_value_id = dynamic_enum_value.id
            WHERE dynamic_enum_value.value_type = 0 AND dynamic_enum_value.value IS NOT NULL";

        $local_netsuite_tickets = DB::select($query);

        return $local_netsuite_tickets;
    }


    // get all customers from local database that have a netsuite id (value_type = 0)
    public static function getAllCustomers() {

        // grab local employee list
        $query = "select entity.id as entity_id ,  dynamic_enum_value.id as dynamic_enum_value_id, dynamic_enum_value.value, dynamic_enum_value.value_type
            from entity
            LEFT  JOIN object_dev ON entity.id = object_dev.object_id
            LEFT  JOIN dynamic_enum_value ON object_dev.dynamic_enum_value_id = dynamic_enum_value.id
            WHERE dynamic_enum_value.value_type = 0 AND dynamic_enum_value.value IS NOT NULL";

        $local_netsuite_customers = DB::select($query);

        return $local_netsuite_customers;
    }

}