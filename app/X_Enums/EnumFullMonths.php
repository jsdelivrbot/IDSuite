<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 8/31/17
 * Time: 11:16 AM
 */

namespace App\Enums;


class EnumFullMonths extends Enum
{

    public static $class_code = 'EFM';

    public static $enum = [
        0   =>  'january',
        1   =>  'february',
        2   =>  'march',
        3   =>  'april',
        4   =>  'may',
        5   =>  'june',
        6   =>  'july',
        7   =>  'august',
        8   =>  'september',
        9   =>  'october',
        10  =>  'november',
        11  =>  'december'
    ];

}