<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 7/3/17
 * Time: 12:13 AM
 */

namespace App\Enums;


class EnumAnalyticType extends Enum
{
    public static $class_code = 'EAN';

    public static $enum = [
        0   =>  'count',
        1   =>  'total',
        2   =>  'sum',
        3   =>  'difference',
        4   =>  'multiplication',
        5   =>  'division'
    ];
}