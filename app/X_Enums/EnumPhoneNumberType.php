<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/6/17
 * Time: 10:38 AM
 */

namespace App\Enums;


class EnumPhoneNumberType extends Enum
{

    public static $class_code = 'PHN';

    public static $enum = [
        0   =>  'Default',
        1   =>  'Home',
        2   =>  'Office',
        3   =>  'Fax',
        4   =>  'Mobile'

    ];
}