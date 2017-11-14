<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Record;

use Illuminate\Support\Facades\DB;

use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('datatables.index', ['viewname' => 'DataTables']);
    }

    /**
     * Process datatables ajax request.
     */
    public function getRecordsTable(Request $request, $options)
    {

        $options = json_decode($options);

        $object = $this->validateObject($options);

        if(get_class($object) === "App\Entity") {
            $records = DB::table('record')
                ->leftjoin('timeperiod', 'record.timeperiod_id', '=', 'timeperiod.id')
                ->select('record.id as record_id', 'local_name', 'remote_name', 'start', 'direction', 'duration')
                ->where('record.entity_id', '=', $object->id);
        } elseif (get_class($object) === "App\Endpoint"){
            $records = DB::table('record')
                ->leftjoin('timeperiod', 'record.timeperiod_id', '=', 'timeperiod.id')
                ->leftjoin('endpoint', 'record.endpoint_id', '=', 'endpoint.id')
                ->select('record.id as record_id', 'local_name', 'remote_name', 'start', 'direction', 'duration')
                ->where('endpoint.entity_id', '=', $object->id);
        } elseif(get_class($object) === "App\User") {
            $records = DB::table('record')
                ->leftjoin('timeperiod', 'record.timeperiod_id', '=', 'timeperiod.id')
                ->select('record.id as record_id', 'local_name', 'remote_name', 'start', 'direction', 'duration');
        } else{
            return response()->json([
                'request'   => $request->path(),
                'error'     => 'The id must be valid and of type Entity, User, or Endpoint'
            ]);
        }


        $request = new \Yajra\Datatables\Request($request);

        $datatables = new Datatables($request);

        session(['recordTableCount' => $records->get()->count()]);

        return $datatables->of($records)->make(true);
    }


    public function getRecordTableCount(){

        return session('recordTableCount');

    }


}
