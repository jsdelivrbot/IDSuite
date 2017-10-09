<?php

/**
 * Created by PhpStorm.
 * User: amac
 * Date: 9/12/17
 * Time: 9:59 AM
 */

namespace App\Http\Controllers;

use App\Enums\EnumParticipantType;
use App\Events\EventCallStatus;
use App\Events\LivePods;
use App\Events\MutePatient;
use App\Events\PodCount;
use App\Events\PodKey;
use App\VidyoTokenGenerator;
use App\Participant;
use App\Pod;
use function GuzzleHttp\Psr7\parse_request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;

class MedsitterController extends Controller
{
    public function index(){

        return view('Medsitter.home', ['viewname' => 'Medsitter / Home']);

    }


    public function sitter($id){

        $pod = Pod::getObjectById($id);

        $sitter = new Participant();

        $sitter->setType('sitter');
        $sitter->setFirstName('test');
        $sitter->setLastName('sitter');
        $sitter->setMuted(false);

        $sitter->save();

        $pod->joinSitter($sitter);

        event(new EventCallStatus($sitter));
        event(new PodCount($pod));

        return view('Medsitter.sitter', ['viewname' => 'Medsitter / Sitter', 'sitter' => $sitter, 'pod' => $pod]);


    }

    public function dropSitter(){

        $sitter = Participant::getObjectById(Input::get('sitter_id'));

        $pod = Pod::getObjectById(Input::get('pod_id'));

        $pod->dropSitter($sitter);

        event(new PodCount($pod));
    }

    public function patient($pod_id, $participant_id){

        $participant = Participant::getObjectById($participant_id);

        $pod = Pod::getObjectById($pod_id);

        $pod->joinParticipant($participant);

        $tokenObj = new VidyoTokenGenerator($pod_id . '-' . $participant_id);

        $token = $tokenObj->getToken();

        event(new EventCallStatus($participant));
        event(new PodCount($pod));
        event(new PodKey($token, $tokenObj->getRoom(), $pod_id));

        return view('Medsitter.patient', ['viewname' => 'Medsitter / Patient', 'participant' => $participant, 'pod' => $pod, 'vidyotoken' => $token, 'room' => $tokenObj->getRoom()]);
    }

    public function participant(){

        $first_name = Input::get('firstname');
        $last_name = Input::get('lastname');
        $phone_number = Input::get('phonenumber');
        $mute_status = Input::get('microphonestatus');
        $type = Input::get('type');


        $participant = new Participant();

        $participant->setFirstName($first_name);
        $participant->setLastName($last_name);
        $participant->setType($type);
        $participant->setMuted($mute_status);

        $participant->save();

        return response()->json([
            'participant_id' => $participant->id
        ]);

    }

    public function dropParticipant(){

        $participant = Participant::getObjectById(Input::get('participant_id'));

        $pod = Pod::getObjectById(Input::get('pod_id'));

        $pod->dropParticipant($participant);

        event(new PodCount($pod));
    }


    public function library(){

        $pods = Pod::where('completed','=',0)->get()->sortByDesc('updated_at');

        return view('Medsitter.library', ['viewname' => 'Medsitter / Room Library', 'pods' => $pods]);

    }


    public function pod(){

        return view('Medsitter.pod', ['viewname' => 'Medsitter / Room']);

    }

    public function createPod(){

        $name = Input::get('name');

        $pod = new Pod();

        $pod->setName($name);

        $pod->save();

        event(new LivePods($pod));

        return response()->json([
            'pod'  => $pod
        ]);

    }


    public function muteToggle(){

        $pod = Input::get("pod_id");

        $participant = Input::get("participant_id");

        event(new MutePatient(Pod::getObjectById($pod), Participant::getObjectById($participant)));

        return response()->json("Mute event has been created");

    }

    public function muteAll(){



    }

}