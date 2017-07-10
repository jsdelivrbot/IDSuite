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
        $records = DB::table('record')
            ->leftjoin('timeperiod', 'record.timeperiod_id', '=', 'timeperiod.id')
            ->select('record.id as record_id', 'local_name', 'remote_name', 'start', 'duration');

        return Datatables::of($records)->make(true);
    }
}
