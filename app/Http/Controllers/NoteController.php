<?php

namespace App\Http\Controllers;

use App\Entity;
use App\Note;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class NoteController extends Controller
{


    /**
     *
     * getNotes
     *
     * returns note data given an entity_id
     *
     * @param $options
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNotes($options)
    {

        $options = json_decode($options);

        /**
         * @var Entity $entity
         */
        $entity = $this->validateObject($options);

        return response()->json($entity->notes);
    }

    /**
     *
     * createNote
     *
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createNote($options)
    {
        $options = json_decode($options);

        /**
         * @var Entity $entity
         */
        $entity = $this->validateNoteOptions($options);

        $text = $options->text;

        $note = new Note();

        $note->text = $text;

        $note->save();

        $entity->notes()->save($note);

        return response()->json($note);

    }


    public function validateNoteOptions($options)
    {
        if (!isset($options->entity_id)) {
            abort(200, 'The options object requires an entity_id key and a valid value for that key.');
        } elseif(!isset($options->user_id)){
            abort(200, 'The options object requires a user_id key and a valid value for that key.');
        } elseif (strlen($options->text) < 3){
            abort(200, 'The note text value must have more than 3 characters to be created');
        }


        $user = User::getObjectById($options->user_id);

        if($user === null){
            abort(200, 'The id ' . $options->user_id . ' is not associated with a valid user.');
        }

        $entity = Entity::getObjectById($options->entity_id);

        if($entity === null){
            abort(200, 'The entity with an id of ' . $options->entity_id . ' was not found.');
        }

        return $entity;

    }

}
