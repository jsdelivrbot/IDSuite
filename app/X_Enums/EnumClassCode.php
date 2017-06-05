<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/5/17
 * Time: 12:45 PM
 */

namespace App\Enums;


class EnumClassCode extends Enum
{
    public static $class_code = 'ECC';

    public static $enum = [
        'Contact'           => 'CON',
        'Coordinate'        => 'COR',
        'Customer'          => 'CUS',
        'Email'             => 'EML',
        'Location'          => 'LOC',
        'PersonName'        => 'NAM',
        'TimePeriod'        => 'TMP',
        'User'              => 'USR',
        'EnumClassCode'     => 'ECC'
    ];
}