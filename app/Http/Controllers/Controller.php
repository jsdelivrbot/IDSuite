<?php

namespace App\Http\Controllers;

use App\Enums\EnumClassCode;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     *
     * getClassPathFromId
     *
     * returns the
     *
     * @param $options
     * @return string
     */
    public function getClassPathFromId($options)
    {
        $class = substr($options->id, 0, 3);
        return '\App\\' . EnumClassCode::getKeyByValue($class);
    }

    /**
     *
     * validateObject
     *
     * validates object related to the id passed into the options object.
     *
     * @param $options
     * @return mixed $object
     */
    public function validateObject($options)
    {

        if (!isset($options->id)) {
            abort(200, 'The options object requires at least an id key and a valid value for that key.');
        }

        $class_path = $this->getClassPathFromId($options);

        $object = $class_path::getObjectById($options->id);

        if($object === null){
            if($class_path === '\App\User'){
                abort(200, 'The id ' . $options->id . ' is not associated with a valid user.');
            } else {
                abort(200, 'The '. $class_path .' object with an id of ' . $options->id . ' was not found.');
            }
        }


        return $object;
    }

}
