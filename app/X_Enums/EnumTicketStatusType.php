<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 7/12/17
 * Time: 10:19 AM
 */

namespace App\Enums;


class EnumTicketStatusType extends Enum
{

    public static $class_code = 'ETS';

    public static $enum = [
        0       =>  'unknown',
        1       =>  'in progress',
        2       =>  're-opened',
        3       =>  'pending on-site',
        4       =>  'Hold- Awaiting Customer Response',
        5       =>  'rma - requires netsuite entry update',
        6       =>  'closed',
        7       =>  'non support email',
        8       =>  'closed on first call',
        9       =>  'closed - sent back to sales rep',
        10      =>  'closed due to non response',
    ];
}