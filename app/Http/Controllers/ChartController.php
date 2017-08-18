<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 7/25/17
 * Time: 12:39 PM
 */

namespace App\Http\Controllers;


use App\Endpoint;
use App\EndpointModel;
use App\Entity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ChartController
{

    /**
     *
     * Returns data needed to build device by type chart
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function index()
    {

        $output = "Main API page";
        return $output;
    }


    public static function callVolumeOverTime(){


        if(session('callvolumedata') === null) {

            $entity = Entity::getObjectById(session('currentaccount'));

            $records_array = array();

            $endpoints_array = array();

            $label_array = array();

            $data_array = array();

            $cost = 0;


            foreach ($entity->endpoints as $endpoint) {
                foreach ($endpoint->records as $record) {
                    $records_array[] = $record;
                }
            }

            $year1 = new \stdClass();
            $year1->year = "2014";
            $year1->value = 0;

            $year2 = new \stdClass();
            $year2->year = "2015";
            $year2->value = 0;

            $year3 = new \stdClass();
            $year3->year = "2016";
            $year3->value = 0;

            $year4 = new \stdClass();
            $year4->year = "2017";
            $year4->value = 0;

            $years = ['2014' => 0, '2015' => 0, '2016' => 0, '2017' => 0];

            foreach ($records_array as $record) {
                switch (substr($record->timeperiod->start, 0, 4)) {
                    case '2014':
                        $year1->value = $year1->value + 1;
                        break;
                    case '2015':
                        $year2->value = $year2->value + 1;
                        break;
                    case '2016':
                        $year3->value = $year3->value + 1;
                        break;
                    case '2017':
                        $year4->value = $year4->value + 1;
                        break;
                }

            }


            $data = array($year1, $year2, $year3, $year4);

            session(["callvolumedata" => $data]);

        } else {
            $data = session('callvolumedata');
        }



        return response()->json($data);
    }


    /**
     *
     * Returns for an account the devices it has.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function deviceByType(){

        $user = Auth::user();

        $entity = Entity::getObjectById(session('currentaccount'));

        $endpoints = $entity->endpoints;

        $models = EndpointModel::getAllModels();

        $model_names_value_array = array();

        $names = array();

        $values = array();

        foreach ($models as $model) {

            $m = new \stdClass();

            $m->name = $model->manufacturer . " " . $model->name . " " . $model->edition;
            $m->value = 0;

            $model_names_value_array[] = $m;
        }

        foreach ($endpoints as $endpoint){
            foreach ($model_names_value_array as $name) {
                if($endpoint->endpointmodel !== null) {
                    if ($endpoint->endpointmodel->manufacturer . " " . $endpoint->endpointmodel->name . " " . $endpoint->endpointmodel->edition === $name->name) {
                        $name->value = $name->value + 1;
                    }
                }
            }
        }

        $cleaned_values = array();

        foreach ($model_names_value_array as $name){
            if($name->value > 0){
                $cleaned_values[] = $name;
            }

        }

        return response()->json($cleaned_values);

    }



    /**
     *
     * returns data needed to build device up status for all devices chart
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deviceUpStatusAll(){
        $entity = Entity::getObjectById(session('currentaccount'));

        $up_value = new \stdClass();
        $up_value->count = 0;
        $up_value->state = "Up";
        $up_value->color = "#008000";


        $down_value = new \stdClass();
        $down_value->count = 0;
        $down_value->state = "Down";
        $down_value->color = "#FF0000";


        foreach ($entity->endpoints as $endpoint){
            if($endpoint->status === 'u'){
                $up_value->count = $up_value->count + 1;
            } else {
                $down_value->count = $down_value->count + 1;
            }
        }

        $data = array($up_value, $down_value);

        return response()->json($data);

    }



    /**
     *
     * returns data needed to build device up status for all devices chart
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deviceUpStatusPercentAll(){
        $entity = Entity::getObjectById(session('currentaccount'));

        $endpoints = $entity->endpoints;

        $up_value = 0;

        $down_value = 0;

        $status = array();

        foreach ($endpoints as $endpoint){
            if($endpoint->status === 'u'){
                $up_value++;
            } else {
                $down_value++;
            }
        }

        $total = $up_value + $down_value;

        if($total !== 0) {
            $up_value = round(($up_value / $total) * 100);
            $down_value = round(($down_value / $total) * 100);
            $status[] = $up_value;
            $status[] = $down_value;

            return response()->json([
                'status'    => $status
            ]);

        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }


    /**
     *
     * device cost per call average
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deviceCostPerCallAvg(){
        $endpoint = Endpoint::getObjectById(session('currentendpoint'));

        $records = $endpoint->records;

        $count = 1;


        if($endpoint->endpointmodel !== null) {
            $cost = $endpoint->endpointmodel->price;
        } else {
            $cost = 3000;
        }

        $label_array = array();
        $data_array = array();

        foreach ($records as $record){

            $label_array[] = $record->timeperiod->start;

            $data_array[] = $cost/$count;

            $count++;
        }

        return response()->json([
            'labels'    => $label_array,
            'data'    => $data_array
        ]);

    }



    public function devicePingData(){

        //TODO waiting for brick to give me zabbix endpoint list.
        $isAggregate    = Input::get('isAggregate');
        $id             = Input::get('isAggregate');
        $sortfield      = Input::get('isAggregate');

        ZabbixController::getHistory($id, $sortfield);


    }

    public function vot()
    {

        dd("innn");

        if (Request::isMethod('post'))
        {

            // day interval by default
            $interval_group_by = "DATE(timeperiod.start)";
            $interval_select = "DATE(timeperiod.start)";

            if(Input::has('interval')) {

                if(Input::get('interval') =="week") {
                    $interval_group_by = "YEAR(timeperiod.start), WEEKOFYEAR(timeperiod.start)";
                    $interval_select = "CONCAT(DATE(timeperiod.start), '+7d')";
                }
                elseif(Input::get('interval') =="month") {
                    $interval_group_by = "YEAR(timeperiod.start), MONTH(timeperiod.start)";
                    $interval_select = "CONCAT(MONTHNAME(timeperiod.start), ' - ',YEAR(timeperiod.start))";
                }
                elseif(Input::get('interval') =="year") {
                    $interval_group_by = "YEAR(timeperiod.start)";
                    $interval_select = "YEAR(timeperiod.start)";
                }

            }
            $cust_id = (!(Input::get['customer_id'])) ? Input::get['customer_id'] : null;
            $customer_string = ($cust_id == null) ? "endpoint.entity_id != null " : "endpoint.entity_id = ".$cust_id;


            $date_from = (Input::has('start_date') && Input::get('start_date') != "" ) ? trim(Input::get('start_date')) : date ( "Y-m-d", strtotime('-30 days',time()));
            $date_to = (Input::has('end_date') && Input::get('end_date') != "" ) ? trim(Input::get('end_date')) :  date ( "Y-m-d", time());


            $query = "SELECT record.id, record.local_name, record.local_number, record.remote_name, record.remote_number, record.dialed_digits, record.direction, record.protocol,
$interval_select as start_time  , timeperiod.end, SUM(timeperiod.duration), endpoint.id as endpoint_id , endpoint.name, entityname.id as entityname_id, entityname.name as entity_name
location.city, location.state, location.zipcode, location.country_code, location.time_zone, coordinate.lat, coordinate.lng
         FROM record
         LEFT JOIN timeperiod ON timeperiod.id = record.timeperiod_id
         LEFT JOIN location ON location.id = remotelocation_id
         LEFT JOIN coordiante ON coordinate.id = location.coordinate_id
      LEFT JOIN customer ON customer.cust_id = endpoint.customer
			WHERE $customer_string
        AND date(timeperiod.start) >= '$date_from'
        AND date(timeperiod.end) <= '$date_to'
	GROUP BY ".$interval_group_by."
	ORDER BY  DATE(timeperiod.start) ASC	
		";



            $query2 = "
	select cdr_log.row_id as cdr_log_id , SUM(cdr_log.duration) as duration_total, ".$interval_select." as start_time, cdr_log.endpoint_id as endpoint_id,
endpoint.customer as customer_id, customer.cust_name as customer_name
	FROM cdr_log
	LEFT JOIN endpoint ON endpoint.id = cdr_log.endpoint_id
	LEFT JOIN customer ON customer.cust_id = endpoint.customer
			WHERE $customer_string
			AND date(timeperiod.start) >= '$date_from'
			AND date(timeperiod.start) <= '$date_to'
	GROUP BY ".$interval_group_by."
	ORDER BY  DATE(timeperiod.start) ASC	
		";

            dd($query);


            $query_result = DB::select($query);

            echo json_encode($query_result, JSON_PRETTY_PRINT);


        }else {

            echo $this->return_error();

        }
    }

    public function locp()
    {
        return view('chart', ['viewname' => 'chart']);
    }


    private function  return_error () {

        $output = "GET request used. Please use POST and provide the correct variables";
        return $output;

    }

    public function getCustomers() {

        $user = Auth::user();


        $query_result = DB::select(
            "SELECT entity.id, entity.user_id, entityname.name,email.address as email,location.address, location.city, location.state, location.zipcode, location.country_code FROM entity
        LEFT JOIN entitycontact ON entitycontact.id = entity.contact_id
         LEFT JOIN entityname ON entityname.id = entitycontact.entityname_id
         LEFT JOIN location ON location.id = entitycontact.location_id
         LEFT JOIN  email ON email.id = entitycontact.email_id
         WHERE entity.user_id='".$user->id."'");

        //echo response()->json($query_result, 200, [], JSON_PRETTY_PRINT);

        // echo \Response::json($query_result, $status=200, $headers=[], $options=JSON_PRETTY_PRINT);


        echo json_encode($query_result, JSON_PRETTY_PRINT);


    }
}