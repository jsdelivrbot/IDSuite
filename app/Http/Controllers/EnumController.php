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
    public function gender($options){

        $options = json_decode($options);

        $this->validateObject($options);

        $genders = EnumGenderType::$enum;


        return response()->json($genders);

    }

    /**
     *  returns modelType enum
     */
    public function modelType($options){

        $options = json_decode($options);

        $this->validateObject($options);

        $modelTypes = EnumModelType::$enum;


        return response()->json($modelTypes);
    }

    /**
     *  returns classCode enum
     */
    public function classCode($options){

        $options = json_decode($options);

        $this->validateObject($options);

        $classCodes = EnumClassCode::$enum;


        return response()->json($classCodes);
    }

    /**
     *  returns status enum
     */
    public function status($options){

        $options = json_decode($options);

        $this->validateObject($options);

        $status = EnumStatusType::$enum;


        return response()->json($status);
    }

    /**
     *  returns title enum
     */
    public function title($options){

        $options = json_decode($options);

        $this->validateObject($options);

        $titles = EnumTitleType::$enum;


        return response()->json($titles);
    }


    public function phoneType($options){

        $options = json_decode($options);

        $this->validateObject($options);

        $phonetypes = EnumPhoneNumberType::$enum;


        return response()->json($phonetypes);
    }



}
