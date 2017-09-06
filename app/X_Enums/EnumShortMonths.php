<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 8/31/17
 * Time: 12:38 PM
 */

namespace App\Enums;


class EnumShortMonths extends Enum
{

    public static $class_code = 'ESM';

    public static $enum = [
        0   =>  'jan',
        1   =>  'feb',
        2   =>  'mar',
        3   =>  'apr',
        4   =>  'may',
        5   =>  'jun',
        6   =>  'jul',
        7   =>  'aug',
        8   =>  'sept',
        9   =>  'oct',
        10  =>  'nov',
        11  =>  'dec'
    ];

}