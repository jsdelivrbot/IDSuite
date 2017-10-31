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
use App\Events\EventJoinPatient;
use App\Events\EventParticipantJoin;
use App\Events\EventPatientReady;
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

        return view('medsitter.home', ['viewname' => 'medsitter / Home']);

    }


    public function sitter($id){

        $pod = Pod::getObjectById($id);


        if($pod->sitter_count === 0) {

            $sitter = new Participant();

            $sitter->setType('sitter');
            $sitter->setFirstName('test');
            $sitter->setLastName('sitter');
            $sitter->setMuted(false);

            $sitter->save();

            $pod->joinSitter($sitter);

            event(new EventCallStatus($sitter));
            event(new PodCount($pod));

            return view('medsitter.sitter', ['viewname' => 'Medsitter / Sitter', 'sitter' => $sitter, 'pod' => $pod]);
        } else {
            return redirect('/medsitter/lobby');
        }

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

        return view('medsitter.patient', ['viewname' => 'Medsitter / Patient', 'participant' => $participant, 'pod' => $pod, 'vidyotoken' => $token, 'room' => $tokenObj->getRoom()]);
    }


    public function patientJoin(){

        $pod = Input::get('pod_id');
        $patient = Input::get('patient_id');

        $key = "$pod-$patient";

        $url_string = "/medsitter/patient/$pod-$patient";

        event(new EventJoinPatient($url_string, $key));

    }


    public function podDelete(){

        $pod = Pod::getObjectById(Input::get('id'));

        $pod->active = 0;

        $pod->save();

        return response()->json("true");

    }

    public function patientReady(){

        $room_key = Input::get('roomkey');


        event(new EventPatientReady($room_key));

    }

    public function getPod(){

        $pod = Pod::getObjectById(Input::get('pod_id'));

        return response()->json($pod);
    }

    public function generateCode(){

        $pod = Pod::getObjectById(Input::get("pod_id"));

        $pod->generateCode();

        return response()->json($pod->code);

    }

    public function participant(){

        $first_name = Input::get('firstname');
        $last_name = Input::get('lastname');
        $phone_number = Input::get('phonenumber');
//        $mute_status = Input::get('microphonestatus');
//        $type = Input::get('type');
        $pod = Input::get('podid');

        $participant = new Participant();

        $participant->setFirstName($first_name);
        $participant->setLastName($last_name);
        $participant->setType('patient');
        $participant->setMuted(false);

        $participant->save();

        event(new EventParticipantJoin($participant));

        $key = "$pod-$participant->id";

        return response()->json([
            'key' => $key
        ]);

    }

    public function externalparticipant(){

        $first_name = Input::get('firstname');
        $last_name = Input::get('lastname');
        $phone_number = Input::get('phonenumber');
//        $mute_status = Input::get('microphonestatus');
//        $type = Input::get('type');
        $pod = Input::get('podid');

        $code = Input::get('code');

        $participant = new Participant();

        $participant->setFirstName($first_name);
        $participant->setLastName($last_name);
        $participant->setType('patient');
        $participant->setMuted(false);

        $participant->save();

        event(new EventParticipantJoin($participant, $code));

        $key = "$pod-$participant->id";

        return response()->json([
            'key' => $key
        ]);

    }


    public function getPods(){

        $pods = Pod::getPods();

        return response()->json($pods);

    }

    public function externalJoinView(){

        $pods = Pod::getActivelyLooking();

        return view('medsitter.external_join', ['viewname' => 'Patient Join', 'pods' => $pods]);

    }

    public function externalJoin(){

        $code = Input::get('code');

        return response()->json($code);
    }

    public function dropParticipant(){

        $participant = Participant::getObjectById(Input::get('participant_id'));

        $pod = Pod::getObjectById(Input::get('pod_id'));

        $pod->dropParticipant($participant);

        event(new PodCount($pod));
    }


    public function library(){

        $pods = Pod::where('completed','=',0)->get()->sortByDesc('updated_at');

        $active_patient_count = 0;
        $active_sitter_count = 0;

        foreach ($pods as $pod){

            $active_patient_count = $active_patient_count + $pod->patient_count;

            $active_sitter_count = $active_sitter_count + $pod->sitter_count;

        }

        if($active_sitter_count != 0) {
            $sitter_to_patient_ratio = round($active_patient_count / $active_sitter_count, 2);
        } else {
            $sitter_to_patient_ratio = 0;
        }

        return view('medsitter.library', ['viewname' => 'Medsitter / Lobby', 'pods' => $pods, 'active_paitient_count' => $active_patient_count, 'active_sitter_count' => $active_sitter_count, 'sitter_to_patient_ratio' => $sitter_to_patient_ratio]);

    }


    public function pod(){

        return view('medsitter.pod', ['viewname' => 'Medsitter / Room']);

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

        $participant_id = Input::get("participant_id");

        $participant = Participant::getObjectById($participant_id);

        $participant->setMuted(!$participant->getMuted());

        event(new MutePatient(Pod::getObjectById($pod), $participant));

        return response()->json($participant);

    }

    public function muteAll(){



    }

}