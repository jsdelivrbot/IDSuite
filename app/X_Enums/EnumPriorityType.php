<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 7/12/17
 * Time: 9:41 AM
 */

namespace App\Enums;


class EnumPriorityType extends Enum
{

    public static $class_code = 'EPT';

    public static $enum = [
        0   =>  'unknown',
        1   =>  'low',
        2   =>  'medium',
        3   =>  'high'
    ];
}