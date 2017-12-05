<?php

namespace App\Http\Controllers;

use App\Entity;
use App\Enums\EnumOriginType;
use App\Enums\EnumPriorityType;
use App\Enums\EnumStatusType;
use App\Enums\EnumTicketStatusType;
use App\Enums\EnumTicketType;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class TicketController extends Controller
{


    /**
     *
     * getTickets
     *
     * returns ticket data
     *
     * @param $options
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTickets($options)
    {
        $options = json_decode($options);

        $object = $this->validateObject($options);

        if($object->class_code === 'ENT') {

            $tickets = $object->tickets;
        } elseif($object->class_code === 'USR'){
            $tickets = Ticket::all();
        } else {
            return response()->json(false);
        }

        $tickets_collection = collect();

        foreach($tickets as $t){

            $ticket = new \stdClass();

            $ticket->origin = EnumOriginType::getValueByKey($t->origin_type);
            $ticket->type = EnumTicketType::getValueByKey($t->ticket_type);
            $ticket->priority = EnumPriorityType::getValueByKey($t->priority_type);
            $ticket->status_type = EnumTicketStatusType::getValueByKey($t->status_type);
            $ticket->subject = $t->subject;
            $ticket->reference_id = $t->references()['netsuite'];
            $ticket->duration = $t->duration();


            $tickets_collection->push($ticket);

        }

        return response()->json($tickets_collection);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_ticket = new Ticket;

        $page_tickets = $page_ticket->where('status_type','<', 6)
            ->orderBy('status_type')->paginate(50);

        $tickets_array = array();

        $number_closed = 0;
        $number_in_progress = 0;
        $number_less_60 = 0;
        $number_reopened = 0;
        $number_pending = 0;
        $number_closed_call = 0;


        foreach ($page_tickets as $t){

            $ticket = new \stdClass();

            $ticket->id = $t->id;

            if($t->entity === null){
                $ticket->entity_name = "Unassigned";
            } else {
                $ticket->entity_name = $t->entity->contact->name->name;
            }

            $ticket->origin = EnumOriginType::getValueByKey($t->origin_type);
            $ticket->type = EnumTicketType::getValueByKey($t->ticket_type);
            $ticket->priority = EnumPriorityType::getValueByKey($t->priority_type);
            $ticket->status = EnumTicketStatusType::getValueByKey($t->status_type);
            $ticket->subject = $t->subject;
            $ticket->status_type = $t->status_type;
            $ticket->reference_id = $t->references()['netsuite'];


            $ticket->duration = $t->duration();

            if($t->status_type === 6){
                $number_closed++;
            }

            if($t->status_type === 3){
                $number_pending++;
            }

            if($t->status_type === 2){
                $number_reopened++;
            }

            if($t->status_type === 1){
                $number_in_progress++;
            }

            if($t->status_type === 8){
                $number_closed_call++;
            }

            if($ticket->duration < 5184000){
                $number_less_60++;
            }

            $tickets_array[] = $ticket;

        }


        return view('measure.tickets', ['tickets' => $tickets_array, 'page_tickets' => $page_tickets, 'viewname' => 'Cases', 'number_closed' => $number_closed, 'number_in_progress' => $number_in_progress, 'number_less_60' => $number_less_60, 'number_reopened' => $number_reopened, 'number_pending' => $number_pending, 'number_closed_call' => $number_closed_call]);
    }


    public function filter(){

        $filter = Input::get('filter');

        $page_ticket = new Ticket;

        $page_tickets = $page_ticket->paginate(15);

        $tickets_array = array();

        $number_closed = 0;
        $number_in_progress = 0;
        $number_less_60 = 0;
        $number_reopened = 0;
        $number_pending = 0;
        $number_closed_call = 0;


        foreach ($page_tickets as $t){

            $ticket = new \stdClass();

            $ticket->id = $t->id;

            if($t->entity === null){
                $ticket->entity_name = "Unassigned";
            } else {
                $ticket->entity_name = $t->entity->contact->name->name;
            }

            $ticket->origin = EnumOriginType::getValueByKey($t->origin_type);
            $ticket->type = EnumTicketType::getValueByKey($t->ticket_type);
            $ticket->priority = EnumPriorityType::getValueByKey($t->priority_type);
            $ticket->status = EnumTicketStatusType::getValueByKey($t->status_type);
            $ticket->subject = $t->subject;
            $ticket->status_type = $t->status_type;
            $ticket->reference_id = $t->references()['netsuite'];
            $ticket->duration = $t->duration();


            if($t->status_type === 6){
                $number_closed++;
            }

            if($t->status_type === 3){
                $number_pending++;
            }

            if($t->status_type === 2){
                $number_reopened++;
            }

            if($t->status_type === 1){
                $number_in_progress++;
            }

            if($t->status_type === 8){
                $number_closed_call++;
            }

            if($ticket->duration < 5184000){
                $number_less_60++;
            }

            $tickets_array[] = $ticket;

        }


        return view('measure.tickets', ['tickets' => $tickets_array, 'viewname' => 'Cases', 'page_tickets' => $page_tickets, 'number_closed' => $number_closed, 'number_in_progress' => $number_in_progress, 'number_less_60' => $number_less_60, 'number_reopened' => $number_reopened, 'number_pending' => $number_pending, 'number_closed_call' => $number_closed_call])->render();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     *
     */
    public function show($id)
    {
        session(['currentticket' => $id]);

        $tic = Ticket::getObjectById($id);

        $ticket = new \stdClass();

        $ticket->id = $tic->id;

        if($tic->entity === null){
            $ticket->entity_name = "Unassigned";
        } else {
            $ticket->entity_name = $tic->entity->contact->name->name;
        }

        $ticket->origin = EnumOriginType::getValueByKey($tic->origin_type);
        $ticket->type = EnumTicketType::getValueByKey($tic->ticket_type);
        $ticket->priority = EnumPriorityType::getValueByKey($tic->priority_type);
        $ticket->status = EnumTicketStatusType::getValueByKey($tic->status_type);

        $ticket->subject = $tic->subject;
        $ticket->status_type = $tic->status_type;
        $ticket->reference_id = $tic->reference_id;

        $ticket->duration = $tic->duration();

        $tickets_array[] = $ticket;

        session(['randomnumber' => rand(1,5)]);

        return view('measure.ticket', ['viewname' => 'case','name' => $ticket->reference_id, 'ticket' => $ticket, 'number' => session('randomnumber')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
