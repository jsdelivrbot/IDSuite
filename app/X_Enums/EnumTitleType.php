<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/9/17
 * Time: 12:42 PM
 */

namespace App\Enums;


class EnumTitleType extends Enum
{

    public static $class_code = 'ETI';

    public static $enum = [
        0   =>  'Mr.',
        1   =>  'Ms.',
        2   =>  'Mrs.',
        3   =>  'Dr.'
    ];
}