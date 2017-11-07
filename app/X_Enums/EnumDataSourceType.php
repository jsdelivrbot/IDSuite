<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 7/22/17
 * Time: 2:05 AM
 */

namespace App\Enums;

class EnumDataSourceType extends Enum
{

    public static $class_code = 'EDS';



    public static $enum = [
        0   =>  'netsuite',
        1   =>  'zabbix',
        2   =>  'mrge',
        3   =>  'polycom',
        4   =>  'zoom',
        5   =>  'vidyo',
        6   =>  'lifesize',
        7   =>  'hms'
    ];

    const netsuite = 0;
    const zabbix = 1;
    const mrge = 2;
    const polycom = 3;
    const zoom = 4;
    const vidyo = 5;
    const lifesize = 6;
    const hms = 7;

}