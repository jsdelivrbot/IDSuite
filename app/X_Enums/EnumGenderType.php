<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/9/17
 * Time: 12:45 PM
 */

namespace App\Enums;


class EnumGenderType extends Enum
{
    public static $class_code = 'EGT';

    public static $enum = [
        0   =>  'Male',
        1   =>  'Female',
        2   =>  'Not Disclosed'
    ];
}