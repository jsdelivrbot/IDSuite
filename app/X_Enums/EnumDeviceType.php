<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 7/27/17
 * Time: 10:30 AM
 */

namespace App\Enums;

class EnumDeviceType extends Enum
{

    public static $class_code = 'EDT';

    public static $enum = [
        0   =>  'cam',
        1   =>  'camera',
        2   =>  'phone',
        3   =>  'codec',
        4   =>  'module',
        5   =>  'kit',
        6   =>  'softphone',
        7   =>  'software'
    ];

}