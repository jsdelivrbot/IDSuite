<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 7/12/17
 * Time: 9:33 AM
 */

namespace App\Enums;


class EnumTicketType extends Enum
{
    public static $class_code = 'ETT';

    public static $enum = [
        0   =>  'unknown',
        1   =>  'problem',
        2   =>  'concern',
        3   =>  'question',
        4   =>  'managed service',
        5   =>  'in house it / maintenance',
        6   =>  'help desk call',
        7   =>  'proactive',
        8   =>  'research',
        9   =>  'installation of new equipment',
        10  =>  'iko'
    ];
}