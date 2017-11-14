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
use App\Enums\EnumDataSourceType;
use App\Enums\EnumFullMonths;
use App\Enums\EnumMonths;
use App\Enums\EnumShortMonths;
use App\Enums\EnumStatusType;
use App\Enums\EnumTicketStatusType;
use App\Enums\EnumTicketType;
use App\Record;
use Carbon\Carbon;
use function GuzzleHttp\Psr7\try_fopen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ChartController extends Controller
{

    private $average_endpoint_cost = 3000;

    /**
     * @return int
     */
    public function getAverageEndpointCost()
    {
        return $this->average_endpoint_cost;
    }

    /**
     *
     * casesOpened
     *
     * Returns data needed to build device by type chart
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function casesOpened($options)
    {

        $options = json_decode($options);

        /**
         * @var Entity $entity
         */
        $entity = $this->validateObject($options);

        if (!isset($options->start_time)) {
            $year_start = 2016;
            $start_time = Carbon::parse('first day of January ' . $year_start);
        } else {
            $year_start = $options->start_time;
            $start_time = Carbon::parse('first day of January ' . $year_start);
        }

        $cur_year = intval(date("Y"));
        $cur_month = EnumFullMonths::getKeyByValue(date("F"));

        $data_array = array();


        for ($y = $year_start; $y <= $cur_year; $y++) {

            if ($y !== $cur_year) {
                for ($m = 0; $m <= 11; $m++) {

                    $obj = new \stdClass();
                    $obj->date_string = EnumShortMonths::getValueByKey($m) . " " . $y;
                    $obj->year_string = strval($y);
                    $obj->month_string = EnumShortMonths::getValueByKey($m);
                    $obj->month_val = $m;
                    $obj->month_real = $m + 1;
                    $obj->value = 0;

                    if ($m >= 9) {
                        $obj->month_string = strval($m + 1);
                    } else {
                        $obj->month_string = "0" . strval($m + 1);
                    }
                    $data_array[] = $obj;
                }
            } else {
                for ($m = 0; $m <= $cur_month; $m++) {

                    $obj = new \stdClass();
                    $obj->date_string = EnumShortMonths::getValueByKey($m) . " " . $y;
                    $obj->year_string = strval($y);
                    $obj->month_string = EnumShortMonths::getValueByKey($m);
                    $obj->month_val = $m;
                    $obj->month_real = $m + 1;
                    $obj->value = 0;

                    if ($m >= 9) {
                        $obj->month_string = strval($m + 1);
                    } else {
                        $obj->month_string = "0" . strval($m + 1);
                    }

                    $data_array[] = $obj;
                }
            }
        }


        foreach ($entity->tickets as $ticket) {
            foreach ($data_array as $time_frame) {
                if (substr($ticket->incident_date, 0, 4) === $time_frame->year_string && substr($ticket->incident_date, 5, 2) === $time_frame->month_string) {

                    $time_frame->value = $time_frame->value + 1;

                }
            }
        }
        return response()->json($data_array);
    }


    /**
     *
     * accountCases
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function accountCases($options)
    {

        $options = json_decode($options);

        $entity = $this->validateObject($options);

        $data_set = array();

        $data_all = new \stdClass();
        $data_all->type = "All Cases";
        $data_all->less = false;
        $data_set[] = $data_all;

        $data_few = new \stdClass();
        $data_few->type = "Not Closed Cases";
        $data_few->less = 6;
        $data_set[] = $data_few;


        foreach ($data_set as $data) {

            $count = 0;

            foreach (EnumTicketStatusType::getValues() as $value) {

                if ($data->less === false) {
                    $data->$value = 0;
                } else {
                    if ($count < $data_few->less) {
                        $data->$value = 0;
                    } else {
                        continue;
                    }
                }
                $count++;
            }
        }


        foreach ($data_set as $data) {

            foreach ($entity->tickets as $ticket) {

                if ($data->less === false) {


                    switch ($ticket->status_type) {
                        case 0:
                            $data->unknown = $data->unknown + $data->unknown;
                            break;
                        case 1:
                            $p = "in progress";
                            $data->$p = $data->$p + 1;
                            break;
                        case 2:
                            $p = "re-opened";
                            $data->$p = $data->$p + 1;
                            break;
                        case 3:
                            $p = "pending on-site";
                            $data->$p = $data->$p + 1;
                            break;
                        case 4:
                            $p = "Hold - Awaiting Customer Response";
                            $data->$p = $data->$p + 1;
                            break;
                        case 5:
                            $p = "rma - requires netsuite entry update";
                            $data->$p = $data->$p + 1;
                            break;
                        case 6:
                            $p = "closed";
                            $data->$p = $data->$p + 1;
                            break;
                        case 7:
                            $p = "non support email";
                            $data->$p = $data->$p + 1;
                            break;
                        case 8:
                            $p = "closed on first call";
                            $data->$p = $data->$p + 1;
                            break;
                        case 9:
                            $p = "closed - sent back to sales rep";
                            $data->$p = $data->$p + 1;
                            break;
                        case 10:
                            $p = "closed due to non response";
                            $data->$p = $data->$p + 1;
                            break;
                    }
                } else {

                    switch ($ticket->status_type) {
                        case 0:
                            $data->unknown = $data->unknown + $data->unknown;
                            break;
                        case 1:
                            $p = "in progress";
                            $data->$p = $data->$p + 1;
                            break;
                        case 2:
                            $p = "re-opened";
                            $data->$p = $data->$p + 1;
                            break;
                        case 3:
                            $p = "pending on-site";
                            $data->$p = $data->$p + 1;
                            break;
                        case 4:
                            $p = "Hold- Awaiting Customer Response";
                            $data->$p = $data->$p + 1;
                            break;
                        case 5:
                            $p = "rma - requires netsuite entry update";
                            $data->$p = $data->$p + 1;
                            break;
                    }
                }
            }
        }

        return response()->json($data_set);
    }


    /**
     *
     * callVolumeOverTime
     *
     * @param $options
     * @return \Illuminate\Http\JsonResponse
     */
    public function callVolumeOverTime($options)
    {
        $options = json_decode($options);


        /**
         * @var Entity $entity
         */
        $entity = $this->validateObject($options);

        if (!isset($options->start_time)) {
            $year_start = 2016;
            $start_time = Carbon::parse('first day of January ' . $year_start);
        } else {
            $year_start = $options->start_time;
            $start_time = Carbon::parse('first day of January ' . $year_start);
        }

        $cur_year = intval(date("Y"));
        $cur_month = EnumFullMonths::getKeyByValue(date("F"));

        $data_array = array();

        for ($y = $year_start; $y <= $cur_year; $y++) {
            if ($y !== $cur_year) {
                for ($m = 0; $m <= 11; $m++) {

                    $obj = new \stdClass();
                    $obj->date_string = EnumShortMonths::getValueByKey($m) . " " . $y;
                    $obj->year_string = strval($y);
                    $obj->month_string = EnumShortMonths::getValueByKey($m);
                    $obj->month_val = $m + 1;
                    $obj->value = 0;

                    if ($m >= 9) {
                        $obj->month_string = strval($m + 1);
                    } else {
                        $obj->month_string = "0" . strval($m + 1);
                    }
                    $data_array[] = $obj;
                }
            } else {
                for ($m = 0; $m <= $cur_month; $m++) {

                    $obj = new \stdClass();
                    $obj->date_string = EnumShortMonths::getValueByKey($m) . " " . $y;
                    $obj->year_string = strval($y);
                    $obj->month_string = EnumShortMonths::getValueByKey($m);
                    $obj->month_val = $m + 1;
                    $obj->value = 0;

                    if ($m >= 9) {
                        $obj->month_string = strval($m + 1);
                    } else {
                        $obj->month_string = "0" . strval($m + 1);
                    }

                    $data_array[] = $obj;
                }
            }
        }

        /**
         * @var Entity $entity
         */
        foreach ($entity->getRecordsByDate($start_time) as $record) {
            foreach ($data_array as $time_frame) {
                if (substr($record->timeperiod_start, 0, 4) === $time_frame->year_string && substr($record->timeperiod_start, 5, 2) === $time_frame->month_string) {
                    $time_frame->value = $time_frame->value + 1;
                }
            }
        }

        return response()->json($data_array);
    }


    /**
     *
     * deviceByType
     *
     * @param $options
     * @return \Illuminate\Http\JsonResponse
     */
    public function deviceByType($options)
    {
        $options = json_decode($options);

        /**
         * @var Entity $entity
         */
        $entity = $this->validateObject($options);

        $endpoints = $entity->endpoints;

//        $models = EndpointModel::all();

        $model_names_value_array = array();

        foreach($endpoints as $endpoint){

            $model = new \stdClass();

            $model->name = EnumDataSourceType::getValueByKey($endpoint->type);
            $model->value = 0;

            $model_names_value_array[] = $model;
        }

        foreach ($endpoints as $endpoint) {
            foreach ($model_names_value_array as $model) {
                if (EnumDataSourceType::getValueByKey($endpoint->type) === $model->name) {
                    $model->value = $model->value + 1;
                }
            }
        }

//        foreach ($models as $model) {
//
//            $m = new \stdClass();
//
//            $m->name = $model->manufacturer . " " . $model->name . " " . $model->edition . "( " . $model->description . " )";
//            $m->value = 0;
//
//            $model_names_value_array[] = $m;
//        }
//
//        foreach ($endpoints as $endpoint) {
//            foreach ($model_names_value_array as $name) {
//                if ($endpoint->endpointmodel !== null) {
//                    if ($endpoint->endpointmodel->manufacturer . " " . $endpoint->endpointmodel->name . " " . $endpoint->endpointmodel->edition . "( " . $endpoint->endpointmodel->description . " )" === $name->name) {
//                        $name->value = $name->value + 1;
//                    }
//                }
//            }
//        }

        $cleaned_values = array();

        foreach ($model_names_value_array as $name) {
            if ($name->value > 0) {
                $cleaned_values[] = $name;
            }
        }

        return response()->json($cleaned_values);

    }


    public function totalCallDuration($options)
    {
        $options = json_decode($options);

        /**
         * @var Entity $entity
         */
        $entity = $this->validateObject($options);

        if (!isset($options->start_time)) {
            $year_start = 2016;
            $start_time = Carbon::parse('first day of January ' . $year_start);
        } else {
            $year_start = $options->start_time;
            $start_time = Carbon::parse('first day of January ' . $year_start);
        }

        $cur_year = intval(date("Y"));
        $cur_month = EnumFullMonths::getKeyByValue(date("F"));

        $data_array = array();


        for ($y = $year_start; $y <= $cur_year; $y++) {


            if ($y !== $cur_year) {
                for ($m = 0; $m <= 11; $m++) {

                    $obj = new \stdClass();
                    $obj->date_string = EnumShortMonths::getValueByKey($m) . " " . $y;
                    $obj->year_string = strval($y);
                    $obj->month_string = EnumShortMonths::getValueByKey($m);
                    $obj->month_val = $m;
                    $obj->month_real = $m + 1;
                    $obj->value = 0;

                    if ($m >= 9) {
                        $obj->month_string = strval($m + 1);
                    } else {
                        $obj->month_string = "0" . strval($m + 1);
                    }
                    $data_array[] = $obj;
                }
            } else {
                for ($m = 0; $m <= $cur_month; $m++) {

                    $obj = new \stdClass();
                    $obj->date_string = EnumShortMonths::getValueByKey($m) . " " . $y;
                    $obj->year_string = strval($y);
                    $obj->month_string = EnumShortMonths::getValueByKey($m);
                    $obj->month_val = $m;
                    $obj->month_real = $m + 1;
                    $obj->value = 0;

                    if ($m >= 9) {
                        $obj->month_string = strval($m + 1);
                    } else {
                        $obj->month_string = "0" . strval($m + 1);
                    }

                    $data_array[] = $obj;
                }
            }
        }


        foreach ($entity->getRecordsByDate($start_time) as $record) {
            foreach ($data_array as $time_frame) {
                if (substr($record->timeperiod_start, 0, 4) === $time_frame->year_string && substr($record->timeperiod_start, 5, 2) === $time_frame->month_string) {
                    $time_frame->value = $time_frame->value + round($record->timeperiod_duration / 60);
                }
            }
        }
        return response()->json($data_array);

    }


    public function averageCallDuration($options)
    {
        $options = json_decode($options);

        /**
         * @var Entity $entity
         */
        $entity = $this->validateObject($options);

        if (!isset($options->start_time)) {
            $year_start = 2016;
            $start_time = Carbon::parse('first day of January ' . $year_start);
        } else {
            $year_start = $options->start_time;
            $start_time = Carbon::parse('first day of January ' . $year_start);
        }

        $cur_year = intval(date("Y"));
        $cur_month = EnumFullMonths::getKeyByValue(date("F"));

        $data_array = array();


        for ($y = $year_start; $y <= $cur_year; $y++) {


            if ($y !== $cur_year) {
                for ($m = 0; $m <= 11; $m++) {

                    $obj = new \stdClass();
                    $obj->date_string = EnumShortMonths::getValueByKey($m) . " " . $y;
                    $obj->year_string = strval($y);
                    $obj->month_string = EnumShortMonths::getValueByKey($m);
                    $obj->month_val = $m;
                    $obj->month_real = $m + 1;
                    $obj->count = 0;
                    $obj->total = 0;
                    $obj->value = 0;

                    if ($m >= 9) {
                        $obj->month_string = strval($m + 1);
                    } else {
                        $obj->month_string = "0" . strval($m + 1);
                    }
                    $data_array[] = $obj;
                }
            } else {
                for ($m = 0; $m <= $cur_month; $m++) {

                    $obj = new \stdClass();
                    $obj->date_string = EnumShortMonths::getValueByKey($m) . " " . $y;
                    $obj->year_string = strval($y);
                    $obj->month_string = EnumShortMonths::getValueByKey($m);
                    $obj->month_val = $m;
                    $obj->month_real = $m + 1;
                    $obj->count = 0;
                    $obj->total = 0;
                    $obj->value = 0;

                    if ($m >= 9) {
                        $obj->month_string = strval($m + 1);
                    } else {
                        $obj->month_string = "0" . strval($m + 1);
                    }

                    $data_array[] = $obj;
                }
            }
        }


        foreach ($entity->getRecordsByDate($start_time) as $record) {
            foreach ($data_array as $time_frame) {
                if (substr($record->timeperiod_start, 0, 4) === $time_frame->year_string && substr($record->timeperiod_start, 5, 2) === $time_frame->month_string) {
                    $time_frame->count = $time_frame->count + 1;
                    $time_frame->total = $time_frame->total + $record->timeperiod_duration;
                    $time_frame->value = round(($time_frame->total / $time_frame->count) / 60);
                }
            }
        }

        return response()->json($data_array);

    }


    /**
     *
     * returns data needed to build device up status for all devices chart
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deviceUpStatusAll($options)
    {
        $options = json_decode($options);

        /**
         * @var Entity $entity
         */
        $entity = $this->validateObject($options);

        $up_value = new \stdClass();
        $up_value->count = 0;
        $up_value->state = "Up";
        $up_value->color = "#008000";


        $down_value = new \stdClass();
        $down_value->count = 0;
        $down_value->state = "Down";
        $down_value->color = "#FF0000";


        foreach ($entity->endpoints as $endpoint) {
            switch ($endpoint->getStatus()){
                case EnumStatusType::getKeyByValue('up'):
                    $up_value->count = $up_value->count + 1;
                    break;
                case EnumStatusType::getKeyByValue('down'):
                    $down_value->count = $down_value->count + 1;
                    break;
            }
        }

        $data = array($up_value, $down_value);

        return response()->json($data);

    }


    /**
     *
     * deviceUpStatusPercentageAll
     *
     * returns data needed to build device up status for all devices chart
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deviceUpStatusPercentAll($options)
    {
        $options = json_decode($options);

        /**
         * @var Entity $entity
         */
        $entity = $this->validateObject($options);

        $data = $this->devicesStatusCompute($entity);

        return response()->json($data);
    }


    public function protocolBreakout($options)
    {
        $options = json_decode($options);

        /**
         * @var Entity $entity
         */
        $entity = $this->validateObject($options);

        // Types //

        //auto//
        $auto_obj = new \stdClass();
        $auto_obj->type = "Auto";
        $auto_obj->count = 0;
        $auto_obj->percent = 0;
        $auto_obj->subtypes = array();

        //sip//
        $sip_obj = new \stdClass();
        $sip_obj->type = "Sip";
        $sip_obj->count = 0;
        $sip_obj->percent = 0;

        // sip subtype //
        // sip video //
        $sip_video = new \stdClass();
        $sip_video->type = "Sip Video";
        $sip_video->count = 0;
        $sip_video->percent = 0;
        // sip audio //
        $sip_audio = new \stdClass();
        $sip_audio->type = "Sip Audio";
        $sip_audio->count = 0;
        $sip_audio->percent = 0;

        $sip_subtype_array = array(
            $sip_audio,
            $sip_video
        );

        $sip_obj->subtypes = $sip_subtype_array;

        //h323//
        $h323_obj = new \stdClass();
        $h323_obj->type = "H.323";
        $h323_obj->count = 0;
        $h323_obj->percent = 0;

        //h323 subtype //
        //h323 video //
        $h323_video = new \stdClass();
        $h323_video->type = "H.323 Video";
        $h323_video->count = 0;
        $h323_video->percent = 0;

        //h323 audio //
        $h323_audio = new \stdClass();
        $h323_audio->type = "H.323 Audio";
        $h323_audio->count = 0;
        $h323_audio->percent = 0;

        $h323_subtype_array = array(
            $h323_audio,
            $h323_video
        );

        $h323_obj->subtypes = $h323_subtype_array;

        $types_array = array(
            $auto_obj,
            $sip_obj,
            $h323_obj
        );

        $total = 0;

        foreach ($entity->getRecordsByDate() as $record) {
            switch ($record->protocol) {
                case "AUTO":
                    $auto_obj->count = $auto_obj->count + 1;
                    $total = $total + 1;
                    break;
                case "H.323":
                    $h323_obj->count = $h323_obj->count + 1;
                    $h323_video->count = $h323_video->count + 1;
                    $total = $total + 1;
                    break;
                case "h323":
                    $h323_obj->count = $h323_obj->count + 1;
                    $h323_video->count = $h323_video->count + 1;
                    $total = $total + 1;
                    break;
                case "voice_h323":
                    $h323_obj->count = $h323_obj->count + 1;
                    $h323_audio->count = $h323_audio->count + 1;
                    $total = $total + 1;
                    break;
                case "SIP":
                    $sip_obj->count = $sip_obj->count + 1;
                    $sip_video->count = $sip_video->count + 1;
                    $total = $total + 1;
                    break;
                case "sip":
                    $sip_obj->count = $sip_obj->count + 1;
                    $sip_video->count = $sip_video->count + 1;
                    $total = $total + 1;
                    break;
                case "voice_sip":
                    $sip_obj->count = $sip_obj->count + 1;
                    $sip_audio->count = $sip_audio->count + 1;
                    $total = $total + 1;
                    break;
                default:
                    continue;
                    break;
            }
        }


        foreach ($types_array as $type) {
            if ($total !== 0) {
                $type->percent = round(100 * $type->count / $total);
            } else {
                $type->percent = 0;
            }
            foreach ($type->subtypes as $subtype) {

                if ($type->count !== 0) {
                    $subtype->percent = round(100 * $subtype->count / $type->count);
                } else {
                    $subtype->percent = 0;
                }
            }
        }

        return response()->json($types_array);

    }


    /**
     *
     * deviceCostPerCallAvg
     *
     * device cost per call average
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deviceCostPerCallAvg($options)
    {
//        $options = json_decode($options);

        /**
         * @var Endpoint $endpoint
         */
//        $endpoint = $this->validateObject($options);

        $endpoint = Endpoint::getObjectById($options);

        dd($endpoint->records);


        $count = 1;


        if ($endpoint->endpointmodel !== null) {
            $cost = $endpoint->endpointmodel->price;
        } else {
            $cost = $this->getAverageEndpointCost();
        }

        $label_array = array();
        $data_array = array();

        foreach ($records as $record) {

            $label_array[] = $record->timeperiod_start;

            $data_array[] = $cost / $count;

            $count++;
        }

        return response()->json([
            'labels' => $label_array,
            'data' => $data_array
        ]);

    }


    public function devicePingData()
    {

        //TODO waiting for brick to give me zabbix endpoint list.
        $isAggregate = Input::get('isAggregate');
        $id = Input::get('isAggregate');
        $sortfield = Input::get('isAggregate');

        (new ZabbixController)->getHistory($id, $sortfield);


    }

    public function vot()
    {

        dd("innn");

        if (Request::isMethod('post')) {

            // day interval by default
            $interval_group_by = "DATE(timeperiod.start)";
            $interval_select = "DATE(timeperiod.start)";

            if (Input::has('interval')) {

                if (Input::get('interval') == "week") {
                    $interval_group_by = "YEAR(timeperiod.start), WEEKOFYEAR(timeperiod.start)";
                    $interval_select = "CONCAT(DATE(timeperiod.start), '+7d')";
                } elseif (Input::get('interval') == "month") {
                    $interval_group_by = "YEAR(timeperiod.start), MONTH(timeperiod.start)";
                    $interval_select = "CONCAT(MONTHNAME(timeperiod.start), ' - ',YEAR(timeperiod.start))";
                } elseif (Input::get('interval') == "year") {
                    $interval_group_by = "YEAR(timeperiod.start)";
                    $interval_select = "YEAR(timeperiod.start)";
                }

            }
            $cust_id = (!(Input::get['customer_id'])) ? Input::get['customer_id'] : null;
            $customer_string = ($cust_id == null) ? "endpoint.entity_id != null " : "endpoint.entity_id = " . $cust_id;


            $date_from = (Input::has('start_date') && Input::get('start_date') != "") ? trim(Input::get('start_date')) : date("Y-m-d", strtotime('-30 days', time()));
            $date_to = (Input::has('end_date') && Input::get('end_date') != "") ? trim(Input::get('end_date')) : date("Y-m-d", time());


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
	GROUP BY " . $interval_group_by . "
	ORDER BY  DATE(timeperiod.start) ASC	
		";


            $query2 = "
	select cdr_log.row_id as cdr_log_id , SUM(cdr_log.duration) as duration_total, " . $interval_select . " as start_time, cdr_log.endpoint_id as endpoint_id,
endpoint.customer as customer_id, customer.cust_name as customer_name
	FROM cdr_log
	LEFT JOIN endpoint ON endpoint.id = cdr_log.endpoint_id
	LEFT JOIN customer ON customer.cust_id = endpoint.customer
			WHERE $customer_string
			AND date(timeperiod.start) >= '$date_from'
			AND date(timeperiod.start) <= '$date_to'
	GROUP BY " . $interval_group_by . "
	ORDER BY  DATE(timeperiod.start) ASC	
		";

            dd($query);


            $query_result = DB::select($query);

            echo json_encode($query_result, JSON_PRETTY_PRINT);


        } else {

            echo $this->return_error();

        }
    }

    public function locp()
    {
        return view('chart', ['viewname' => 'chart']);
    }


    private function return_error()
    {

        $output = "GET request used. Please use POST and provide the correct variables";
        return $output;

    }

    public function getCustomers()
    {

        $user = Auth::user();


        $query_result = DB::select(
            "SELECT entity.id, entity.user_id, entityname.name,email.address as email,location.address, location.city, location.state, location.zipcode, location.country_code FROM entity
        LEFT JOIN entitycontact ON entitycontact.id = entity.contact_id
         LEFT JOIN entityname ON entityname.id = entitycontact.entityname_id
         LEFT JOIN location ON location.id = entitycontact.location_id
         LEFT JOIN  email ON email.id = entitycontact.email_id
         WHERE entity.user_id='" . $user->id . "'");

        //echo response()->json($query_result, 200, [], JSON_PRETTY_PRINT);

        // echo \Response::json($query_result, $status=200, $headers=[], $options=JSON_PRETTY_PRINT);


        echo json_encode($query_result, JSON_PRETTY_PRINT);


    }

    /**
     *
     * devicesStatusCompute
     *
     * computes necessary value for deviceUpStatusPercentAll
     *
     * @param $entity
     * @return array
     */
    public function devicesStatusCompute($entity)
    {
        $up_value = new \stdClass();
        $up_value->count = 0;
        $up_value->state = "Up";
        $up_value->color = "#008000";

        $down_value = new \stdClass();
        $down_value->count = 0;
        $down_value->state = "Down";
        $down_value->color = "#FF0000";

        $rebooting_value = new \stdClass();
        $rebooting_value->count = 0;
        $rebooting_value->state = "Rebooting";
        $rebooting_value->color = "#FF0000";

        $indeterminate_value = new \stdClass();
        $indeterminate_value->count = 0;
        $indeterminate_value->state = "Indeterminate";
        $indeterminate_value->color = "#FF0000";

        foreach ($entity->endpoints as $endpoint) {
            if ($endpoint->status === EnumStatusType::getKeyByValue("up")) {
                $up_value->count = $up_value->count + 1;
            } elseif ($endpoint->status === EnumStatusType::getKeyByValue("down")) {
                $down_value->count = $down_value->count + 1;
            } elseif ($endpoint->status === EnumStatusType::getKeyByValue("Rebooting")) {
                $rebooting_value->count = $rebooting_value->count + 1;
            } else {
                $indeterminate_value->count = $indeterminate_value->count + 1;
            }
        }

        return array($up_value, $down_value, $rebooting_value, $indeterminate_value);
    }
}