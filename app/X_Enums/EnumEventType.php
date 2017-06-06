<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/6/17
 * Time: 10:34 AM
 */

namespace App\Enums;


class EnumEventType extends Enum
{
    public static $class_code = 'ETT';

    public static $enum = [
        0   =>  'status',
        1   =>  'properties',
        2   =>  'action'
    ];
}