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
        0       =>  'Unknown',
        1       =>  'Not Started',
        2       =>  'In Progress',
        3       =>  'Escalated',
        4       =>  'Re-Opened',
        5       =>  'Closed',
        7       =>  'Hold- Awaiting Customer Response',
        8       =>  'Closed Due to Non Response',
        9       =>  'Hold - Awaiting Vendor Response',
        10      =>  'Non support email',
        11      =>  'RMA - In Progress',
        12      =>  'Pending On-Site',
        13      =>  'Closed on First Call',
        14      =>  'Closed - Sent back to Sales Rep',
        15      =>  'RMA - Requires NetSuite Entry Update',

    ];
    const UNKNOWN =0;
    const NOT_STARTED =1;
    const IN_PROGRESS =2;
    const ESCALATED =3;
    const RE_OPENED =4;
    const CLOSED =5;
    const HOLD_AWAITING_CUSTOMER_RESPONSE =7;
    const CLOSED_DUE_TO_NONE_RESPONSE =8;
    const HOLD_AWAITING_VENDOR_RESPONSE =9;
    const NON_SUPPORT_EMAIL =10;
    const RMA_IN_PROGRESS =11;
    const PENDING_ON_SITE =12;
    const CLOSED_ON_FIRST_CALL =13;
    const CLOSED_SENT_BACK_TO_SALES_REP =14;
    const RMA_REQUIRES_NETSUITE_ENTRY_UPDATE =15;

}