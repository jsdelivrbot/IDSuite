<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use function MongoDB\BSON\toJSON;

class TestController extends Controller
{
    
	public function test(){
        $coordinates = new \App\Coordinate();

        $coordinates->lat = '42.12';
        $coordinates->long = '123.11';

        $coordinates->save();
        dump($coordinates);

        $coordinates = new \App\Coordinate();

        $coordinates->lat = '42.12';
        $coordinates->long = '123.11';

        $coordinates->save();
        dump($coordinates);

        $coordinates = new \App\Coordinate();

        $coordinates->lat = '42.12';
        $coordinates->long = '123.11';

        $coordinates->save();
        dump($coordinates);


        $location = new \App\Location($coordinates, '3asdfo blue blvd', 'Whitestown', 'IN', '46075');

        $value = \App\Enums\EnumClassCode::getValueByKey('\App\User');

        dd($location);

    }


}
