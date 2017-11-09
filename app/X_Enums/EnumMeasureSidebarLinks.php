<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 11/8/17
 * Time: 1:24 PM
 */

namespace App\X_Enums;

use App\Enums\Enum;

class EnumMeasureSidebarLinks extends Enum
{
    public static $class_code = 'EMSL';

    public static $enum = [
        'Accounts'      => ["url" => "/measure/accounts",       "class" => "btn-outline-teal"],
        'Transactions'  => ["url" => "/measure/transactions",   "class" => "btn-outline-pink"],
        'Devices'       => ["url" => "/measure/devices",        "class" => "btn-outline-purple"],
        'Reports'       => ["url" => "/measure/reports",        "class" => "btn-outline-yellow"],
        'Cases'         => ["url" => "/measure/tickets",        "class" => "btn-outline-blue"]
    ];

}