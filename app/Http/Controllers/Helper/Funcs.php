<?php
/**
 * Created by PhpStorm.
 * User: fbreidi
 * Date: 8/15/2017
 * Time: 11:57 AM
 */

namespace App\Http\Controllers\Helper;


class Funcs
{
    public static function split_name($name) {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
        return array($first_name, $last_name);
    }
}