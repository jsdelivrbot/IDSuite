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
    public static $enum = [
        'Analytic'              =>  'ANA',
        'AnalyticValueCache'    =>  'AVC',
        'Coordinate'            =>  'COR',
        'DynamicEnum'           =>  'DEN',
        'DynamicEnumValue'      =>  'DEV',
        'EnumAnalyticType'      =>  'EAT',
        'EnumDataSourceType'    =>  'EDS',
        'EnumDeviceType'        =>  'EDT',
        'EnumEventType'         =>  'EET',
        'EnumGenderType'        =>  'EGT',
        'EnumModelType'         =>  'EMT',
        'EnumOriginType'        =>  'EOT',
        'EnumPriorityType'      =>  'EPT',
        'EnumStatusType'        =>  'EST',
        'EnumTicketStatusType'  =>  'ETS',
        'EnumTicketType'        =>  'ETT',
        'EnumTitleType'         =>  'ETI',
        'Email'                 =>  'EML',
        'Endpoint'              =>  'END',
        'EndpointLog'           =>  'ENL',
        'EndpointModel'         =>  'ENM',
        'Entity'                =>  'ENT',
        'EntityContact'         =>  'ECN',
        'EntityName'            =>  'ENN',
        'Location'              =>  'LOC',
        'Note'                  =>  'NOT',
        'PersonContact'         =>  'PCN',
        'PersonName'            =>  'NAM',
        'PhoneNumber'           =>  'PHN',
        'Proxy'                 =>  'PRX',
        'Record'                =>  'REC',
        'Ticket'                =>  'TIC',
        'TimePeriod'            =>  'TMP',
        'User'                  =>  'USR',
        'Website'               =>  'WEB'

    ];
}