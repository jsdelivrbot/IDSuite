<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/6/17
 * Time: 10:52 AM
 */

namespace App\Enums;


class EnumStatus extends Enum
{
    public static $class_code = 'EST';

    public static $enum = [
        0   =>  'up',
        1   =>  'down',
        2   =>  'rebooting',
        3   =>  'indeterminate'
    ];
}