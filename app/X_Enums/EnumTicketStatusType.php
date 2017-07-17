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
        0   =>  'unknown',
        1   =>  'in progress',
        2   =>  're-opened',
        3   =>  'closed due to non response',
        4   =>  'closed',
        5   =>  'non support email',
        6   =>  'closed on first call',
        7   =>  'rma - requires netsuite entry update',
        8   =>  'closed - sent back to sales rep',
        9   =>  'pending on-site',
        10  =>  'Hold- Awaiting Customer Response'
    ];
}