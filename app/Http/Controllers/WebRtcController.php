<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aloha\Twilio\Support\Laravel\Facade as Phone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;

class WebRtcController extends Controller
{

    public $contacts = array(
        'Adam'=> '3174377855',
        'Heather' => '3174593019',
        'Tim' => '3176168897',
        'Mike' => '3176251523',
        'Steve' => '3176458805',
        'Stephanie' => '3177034280',
        'Jonathan' => '3177034405',
        'Alli' => '3177039433',
        'Jerry' => '3177039897',
        'McKay' => '3177090002',
        'Michael' => '3177090003',
        'Bryan' => '3177090005',
        'Chris' => '3177538491',
        'Amy' => '3177744608',
        'Tracy' => '3178470000',
        'Patrick' => '3179006022',
        'Kara' => '3179006826',
        'Nathan' => '3179223759',
        'Katherine' => '3179226746',
        'Deidra' => '3179228939',
        'Kayla' => '3179228944',
        'Eric' => '3179229181',
        'Miguel' => '3179229233',
        'Paul' => '3179229234',
        'Dani' => '3179229610',
        'Richard' => '3179229909',
        'Rob' => '4194507716',
        'Kaylene' => '6035020641',
        'Brian' => '6035311514',
        'Marlow' => '6164068687',
        'Eli' => '7653184976',
        'Fawzi' => '7654307268',
        'Corey' => '7656213190',
        'John' => '8473161240',
        'Zandy' => '9162028052',
        'Josh' => '9162931942',
        'Todd' => '9165092387',
        'Marc' => '9165860347',
        'Ryan' => '9165866623',
        'Aryss' => '9165866940',
        'Cherry' => '9168019094',
        'Christopher' => '2032589874',
        'Tom' => '2033955728',
        'Sandy' => '2039806169',
        'Carmen' => '2143643403',
        'Brittany' => '2172326000',
        'Kevin' => '3172198884',
        'Matt' => '3172700503',
        'Stephen' => '3172702046',
        'Alex' => '3173166329',
        'Jodi' => '3173166351',
        'Zac' => '3173193695',
        'Mychal' => '3173630268',
        'Angie' => '3173795899',
        'Dan' => '3173799641',
        'Ian' => '3173836788',
        'Juan' => '3174035326',
        'Gail' => '3174132999',
        'Brick' =>'3174354291',
        'Brad' => '3174356161',
        'Anthony' => '3174376965',
    );


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('webrtc', ['viewname' => 'webrtc', 'user_id' => Auth::user()->id]);
    }

    public function sendMessage(){

        try {
            $number = Input::get('number');
            $text = Input::get('text');

            Phone::message($number, $text);

            $response = "Sent!";

            $status = "success";

        } catch(\Services_Twilio_RestException $e){

            $status = "error";

            $response = $e->getMessage();

        }

        return response()->json([
            'status' => $status,
            'data'   => $response
        ]);

    }


    public function sendMessageToAll(){



        foreach ($this->contacts as $name => $number) {

            $text = "Hello " . $name . " welcome to the World of IDSuite.";

            Phone::message($number, $text);

        }


        return response()->json([
            'sent'
        ]);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
