<?php

namespace App\Http\Controllers\Netsuite;

use Illuminate\Http\Request;
use NetSuite\Classes\SearchStringFieldOperator;
use NetSuite\NetSuiteService;
use Illuminate\Support\Facades\App;
/*
 * Netsuite operators: contains, doesNotContain, doesNotStartWith, empty, hasKeywords, is, isNot, notEmpty, within, noneOf
 * */


class NetsuiteController extends \App\Http\Controllers\Controller
{

    const LOG_FILE = 'netsuite.log';
    const AUTH_TYPE = "user"; // user or token
    private $service;


    public function __construct()
    {


        $log_path = storage_path().'/logs/'.self::LOG_FILE;
         $config = array(
        // required -------------------------------------
        "endpoint" => env('NETSUITE_ENDPOINT', "2016_2"),
        "host"     => env('NETSUITE_HOST', "https://webservices.sandbox.netsuite.com"),
        "role"     => env('NETSUITE_ROLE','3'),
        "account"  => env('NETSUITE_ACCOUNT', '3592634'),
        "app_id"   =>  env('NETSUITE_APPID','7A54F120-BA76-48B2-8C0E-27A9025E7969'),

        //optional -------------------------------------
        "logging"  => true,
        "log_path" => $log_path
    );


         if(self::AUTH_TYPE == 'user') {
             //user based authentication
             $config['email'] = env('NETSUITE_USERNAME','support@e-idsolutions.com');
             $config['password'] = env('NETSUITE_PASSWORD','Webstore14701');

         }else{
            /* token based authentication (need to be enabled)
            reference: https://community.boomi.com/docs/DOC-2675
             */
             $config['consumerKey'] = env('NETSUITE_CONSUMERKEY');
             $config['consumerSecret'] = env('NETSUITE_CONSUMERSECRET');
             $config['token'] =" env('NETSUITE_TOKENS');";
             $config['tokenSecret'] = " env('NETSUITE_TOKENSECRET');";

         }


        $this->service = new NetSuiteService($config);
        $this->service->logRequests(true);

    }

    public function getCustomer($netsuite_internal_id)
    {
        $request = new \NetSuite\Classes\GetRequest();
        $request->baseRef = new \NetSuite\Classes\RecordRef();
        $request->baseRef->internalId = $netsuite_internal_id;
        $request->baseRef->type = "customer";
        $getResponse = $this->service->get($request);
        if (!$getResponse->readResponse->status->isSuccess) {
            return false;
        }else{
            return $getResponse->readResponse->record;

        }
    }

    public function getCustomerAddressBook($netsuite_internal_id)
    {
        $customer = $this->getCustomer($netsuite_internal_id);


        if (!$customer) {
           return false;
        } else {
            $addressBookList = $customer->addressbookList->addressbook;

            if (!is_array($addressBookList))
                $addressBookListArray[]= $addressBookList;
            else
                $addressBookListArray = $addressBookList;
            return $addressBookListArray;
        }
    }



    public function getDataCenterUrl(){

    }


    // grab saved search or list
    public function savedSearch($savedSearchId) {


        $search = new \NetSuite\Classes\CustomRecordSearchAdvanced();
        $search->savedSearchId = $savedSearchId;

        $request = new\NetSuite\Classes\SearchRequest();
        $request->searchRecord = $search;

        $searchResponse = $this->service->search($request);

        if (!$searchResponse->searchResult->status->isSuccess) {
            return false;
        } else {
            return $searchResponse->searchResult;
        }

    }
    public function savedList($savedSearchId) {
        return $this->savedSearch($savedSearchId);

    }



        // grab saved page or report
    public function savedPage($savedSearchId) {


        $search = new \NetSuite\Classes\CustomRecordSearchAdvanced();
        $search->savedSearchId = $savedSearchId;

        $request = new\NetSuite\Classes\SearchRequest();
        $request->searchRecord = $search;

        $searchResponse = $this->service->search($request);

        if (!$searchResponse->searchResult->status->isSuccess) {
            return false;
        } else {
            return $searchResponse->searchResult;
        }

    }
    public function savedReport($savedSearchId) {
        return $this->savedPage($savedSearchId);

    }

    public function getPage($search_id, $page_number =2 ) {

        $request = new\NetSuite\Classes\SearchMoreWithIdRequest();
        $request->searchId = $search_id;
        $request->pageIndex = $page_number;
        $response = $this->service->searchMoreWithId($request);


           if (!$response->searchResult->status->isSuccess) {
               return false;
           } else {
               return $response->searchResult;
           }

    }

    public function searchEmployee($search_value, $operator ="contains", $page_size=20) {

        $this->service->setSearchPreferences(false, $page_size);

        $emailSearchField = new \NetSuite\Classes\SearchStringField();
        $emailSearchField->operator = $operator;
        $emailSearchField->searchValue = $search_value;

        $search = new \NetSuite\Classes\EmployeeSearchBasic();
        $search->email = $emailSearchField;

        $request = new \NetSuite\Classes\SearchRequest();
        $request->searchRecord = $search;

        $searchResponse = $this->service->search($request);

        if (!$searchResponse->searchResult->status->isSuccess) {
            return false;
        } else {
            return $searchResponse->searchResult;
        }

    }
    public function searchCustomer($search_value, $operator ="contains", $page_size=20) {

        $this->service->setSearchPreferences(false, $page_size);

        $emailSearchField = new \NetSuite\Classes\SearchStringField();
        $emailSearchField->operator = $operator;
        $emailSearchField->searchValue = $search_value;

        $search = new \NetSuite\Classes\CustomerSearchBasic();
        $search->email = $emailSearchField;

        $request = new \NetSuite\Classes\SearchRequest();
        $request->searchRecord = $search;

        $searchResponse = $this->service->search($request);

        if (!$searchResponse->searchResult->status->isSuccess) {
           return false;
        } else {
            return $searchResponse->searchResult;
        }

    }

    public function getEmployeeList($page_size=1000) {


        $this->service->setSearchPreferences(false, $page_size);

        $EmployeeSearch = new \NetSuite\Classes\EmployeeSearch;
        $employee_search_basic = new \NetSuite\Classes\EmployeeSearchBasic();
        $EmployeeSearch->basic = $employee_search_basic;

        $request = new \NetSuite\Classes\SearchRequest();
        $request->searchRecord = $EmployeeSearch;

        $searchResponse = $this->service->search($request);


        if (!$searchResponse->searchResult->status->isSuccess) {
            return false;
        } else {
            return $searchResponse->searchResult;
        }

    }


    /*
     * todo: filter by Status	is Customer-Closed Won and	 Inactive	is false

     * */
    public function getAllCustomers($page_size=50) {

        $this->service->setSearchPreferences(false, $page_size);

        // Instantiate a search object for customers.
        $CustomerSearch =  new \NetSuite\Classes\CustomerSearch();
        $CustomerSearchBasic =  new \NetSuite\Classes\CustomerSearchBasic ();

        $filter_customer_statuses = array(15, 13); // Closed Won and Renewal


        $SearchMultiSelectField = new \NetSuite\Classes\SearchMultiSelectField();
        $SearchMultiSelectField->operator = 'anyOf';

        $RecordRefList =  array();
        foreach ($filter_customer_statuses as $filter_customer_status) {
            $RecordRef = new \NetSuite\Classes\RecordRef();
            $RecordRef->internalId = $filter_customer_status;
            $RecordRefList[] = $RecordRef;
        }


        $SearchMultiSelectField->searchValue = $RecordRefList;
        $CustomerSearchBasic->entityStatus = $SearchMultiSelectField;

        $CustomerSearch->basic =$CustomerSearchBasic;


        $request = new \NetSuite\Classes\SearchRequest();
        $request->searchRecord = $CustomerSearch;

        $searchResponse = $this->service->search($request);


        if (!$searchResponse->searchResult->status->isSuccess) {
            return false;
        } else {
            return $searchResponse->searchResult;
        }

    }

    public function getCustomerSalesTeam($netsuite_internal_id) {

        $customer = $this->getCustomer($netsuite_internal_id);

        if (!$customer) {
            return false;
        } else {
            $sales_list = $customer->salesTeamList->salesTeam;

            if (!is_array($sales_list))
                $sales_list_arr[]= $sales_list;
            else
                $sales_list_arr = $sales_list;

            return $sales_list_arr;

        }

    }


    public function searchUserNotes() {


    }
}
