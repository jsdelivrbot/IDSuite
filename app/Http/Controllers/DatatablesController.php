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
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRecordsDataTables()
    {

        $id = session('data_table_id');

        if($id === null) {
            $records = DB::table('record')
                ->leftjoin('timeperiod', 'record.timeperiod_id', '=', 'timeperiod.id')
                ->select('record.id as record_id', 'local_name', 'remote_name', 'start', 'duration');
        } else {
            $records = DB::table('record')
                ->leftjoin('timeperiod', 'record.timeperiod_id', '=', 'timeperiod.id')
                ->leftjoin('endpoint', 'record.endpoint_id', '=', 'endpoint.id')
                ->select('record.id as record_id', 'local_name', 'remote_name', 'start', 'duration')
                ->where('endpoint.entity_id', '=', $id);
        }

        $rec_count = $records->get()->count();

        session(['trans_count' => $rec_count]);

        if( $rec_count === 0){
            return response()->json(false);
        };


        return Datatables::of($records)->make(true);
    }
}
