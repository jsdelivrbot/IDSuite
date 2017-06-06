<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/6/17
 * Time: 10:38 AM
 */

namespace App\Enums;


class EnumModelType extends Enum
{
    public static $class_code = 'EMT';

    public static $enum = [
        0   =>  'room',
        1   =>  'icon',
        2   =>  'group'
    ];
}