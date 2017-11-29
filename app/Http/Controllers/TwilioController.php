<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio;

class TwilioController extends Controller
{

    protected $twilio;

    public function __construct()
    {
        $this->twilio = new \Aloha\Twilio\Twilio(env("TWILIO_SID"), env("TWILIO_TOKEN"), env("TWILIO_FROM"));
    }

    public function send(Request $request)
    {
        $this->validate($request, ['message' => 'required']);

        $message  = $request->input('message');
        $imageUrl = $request->input('imageUrl');
        $number = $request->input('number');

        $this->sendMessage($number, $message, $imageUrl);

        return response()->json('message sent');
    }

    private function sendMessage($phoneNumber, $message, $imageUrl = null)
    {
//        $messageParams = array(
//            'from' => $twilioPhoneNumber,
//            'body' => $message
//        );
//        if ($imageUrl) {
//            $messageParams['mediaUrl'] = $imageUrl;
//        }



        $twilio = new \Aloha\Twilio\Twilio(env("TWILIO_SID"), env("TWILIO_TOKEN"), env("TWILIO_FROM"));

        $twilio->message($phoneNumber, $message, $imageUrl);

    }

}
