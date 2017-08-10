<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 7/12/17
 * Time: 9:28 AM
 */

namespace App\Enums;


class EnumOriginType extends Enum
{

    public static $class_code = 'EOT';

    public static $enum = [
        0   =>  'unknown',
        1   =>  'e-mail',
        2   =>  'phone',
        3   =>  'internal request',
        4   =>  'web'
    ];
}