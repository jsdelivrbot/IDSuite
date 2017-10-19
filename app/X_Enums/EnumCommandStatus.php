<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 7/22/17
 * Time: 2:05 AM
 */

namespace App\Enums;

class EnumCommandStatus extends Enum
{

    public static $class_code = 'CMD';

    public static $enum = [
        0   =>  'created',
        1   =>  'fetched',
        2   =>  'started',
        3   =>  'success',
        4   =>  'failed',
    ];

}