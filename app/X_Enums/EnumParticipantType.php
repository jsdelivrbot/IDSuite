<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 9/28/17
 * Time: 12:12 PM
 */

namespace App\Enums;


class EnumParticipantType extends Enum
{
    public static $class_code = 'EPA';

    public static $enum = [
        0   =>  'sitter',
        1   =>  'patient',
        2   =>  'visitor',
        3   =>  'doctor'
    ];

}