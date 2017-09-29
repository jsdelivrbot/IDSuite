<?php

/**
 * Created by PhpStorm.
 * User: amac
 * Date: 9/12/17
 * Time: 9:59 AM
 */

namespace App\Http\Controllers;

use App\Events\EventCallStatus;
use App\Events\LivePods;
use App\Events\PodCount;
use App\Participant;
use App\Pod;
use function GuzzleHttp\Psr7\parse_request;
use Illuminate\Support\Facades\Input;

class MedsitterController extends Controller
{
    public function index(){

        return view('Medsitter.home', ['viewname' => 'Medsitter / Home']);

    }


    public function sitter($id){

        $pod = Pod::getObjectById($id);

        $sitter = new Participant();

        $sitter->setType('sitter');
        $sitter->setName('testsitter');
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

    public function patient($id, $count){

        $pod = Pod::getObjectById($id);

        $participant = new Participant();

        $participant->setType('patient');
        $participant->setName('testpatient');
        $participant->setMuted(false);

        $pod->joinParticipant($participant);

        event(new EventCallStatus($participant));
        event(new PodCount($pod));

        return view('Medsitter.patient', ['viewname' => 'Medsitter / Patient', 'participant' => $participant, 'pod' => $pod]);
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


    public function muteAll(){



    }

}