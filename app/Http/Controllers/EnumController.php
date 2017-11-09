<?php

namespace App\Http\Controllers;

use App\Enums\EnumClassCode;
use App\Enums\EnumGenderType;
use App\Enums\EnumModelType;
use App\Enums\EnumPhoneNumberType;
use App\Enums\EnumStatusType;
use App\Enums\EnumTitleType;
use App\X_Enums\EnumMeasureSidebarLinks;
use Faker\Generator;
use Illuminate\Http\Request;

class EnumController extends Controller
{

    public function measureLinks($options){

        $options = json_decode($options);

        $this->validateObject($options);

        $links = EnumMeasureSidebarLinks::$enum;

        return response()->json($links);

    }

    /**
     *  returns gender enum
     */
    public function gender(){
        $genders = EnumGenderType::getValues();

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
        $status = EnumStatusType::getKeys();

        return response()->json([
            'data' => $status
        ]);
    }

    /**
     *  returns title enum
     */
    public function title(){
        $titles = EnumTitleType::getValues();

        return response()->json([
            'data' => $titles
        ]);
    }


    public function phoneType(){
        $phonetypes = EnumPhoneNumberType::getValues();

        return response()->json([
            'data' => $phonetypes
        ]);
    }



}
