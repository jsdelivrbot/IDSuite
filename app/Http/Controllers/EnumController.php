<?php

namespace App\Http\Controllers;

use App\Enums\EnumClassCode;
use App\Enums\EnumGender;
use App\Enums\EnumModelType;
use App\Enums\EnumStatus;
use App\Enums\EnumTitle;
use Faker\Generator;
use Illuminate\Http\Request;

class EnumController extends Controller
{

    /**
     *  returns gender enum
     */
    public function gender(){
        $genders = EnumGender::getValues();

        return response()->json([
            'data' => $genders
        ]);

    }

    /**
     *  returns modelType enum
     */
    public function modelType(){
        $modelTypes = EnumModelType::getKeys();

        return response()->json([
            'data' => $modelTypes
        ]);
    }

    /**
     *  returns classCode enum
     */
    public function classCode(){
        $classCodes = EnumClassCode::getKeys();

        return response()->json([
            'data' => $classCodes
        ]);
    }

    /**
     *  returns status enum
     */
    public function status(){
        $status = EnumStatus::getKeys();

        return response()->json([
            'data' => $status
        ]);
    }

    /**
     *  returns title enum
     */
    public function title(){
        $titles = EnumTitle::getValues();

        return response()->json([
            'data' => $titles
        ]);
    }

}
