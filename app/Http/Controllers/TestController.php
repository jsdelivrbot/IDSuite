<?php

namespace App\Http\Controllers;


class TestController extends Controller
{
    
	public function test(){

        $personname = new \App\PersonName();

        $coordinates = new \App\Coordinate();


        $location = new \App\Location();
        $location->coordinate_id = $coordinates->mrge_id;
        $location->save();

        $email = new \App\Email();
	    $contact = new \App\Contact();

	    $contact->person_name_id = $personname->mrge_id;
	    $contact->location_id = $location->mrge_id;
	    $contact->email_id = $email->mrge_id;
	    $contact->save();

	    $customer = new \App\Customer();

	    $customer->contact_id = $contact->mrge_id;
        $customer->save();

        dump($customer);
        dump($customer->contact->location->coordinate);
//
//
//        $user = new \App\User();
//
//        $user->contact_id = $contact->mrge_id;
//        $user->save();
//
//        dump($user);
//
//
//        $endpointmodel = new \App\EndpointModel();
//
//        dump($endpointmodel);
//
//        $proxy = new \App\Proxy();
//
//        $proxy->customer_id = $customer->mrge_id;
//        $proxy->save();
//
//        dump($proxy);
//
//        $endpoint = new \App\Endpoint();
//
//	    $endpoint->customer_id = $customer->mrge_id;
//	    $endpoint->model_id    = $endpointmodel->mrge_id;
//        $endpoint->proxy_id    = $proxy->mrge_id;
//	    $endpoint->save();
//
//        dump($endpoint);
//
//        $endpointlog = new \App\EndpointLog();
//
//        $endpointlog->message = 'Hello World';
//        $endpointlog->save();
//
//        dump($endpointlog);
//
//        $timeperiod = new \App\TimePeriod();
//
//        dump($timeperiod);
//
//        $record = new \App\Record();
//
//        $record->endpoint_id   = $endpoint->mrge_id;
//        $record->timeperiod_id = $timeperiod->mrge_id;
//
//        $record->save();
//        dump($record);



    }


}
