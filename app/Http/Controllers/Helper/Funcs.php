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


//Remove all special characters from a string [duplicate]
public static function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}


        public static function is_multi_array( $arr ) {
        rsort( $arr );
        return isset( $arr[0] ) && is_array( $arr[0] );
    }


    public static function  find_between($string, $start, $end, $trim = true, $greedy = false) {
        $pattern = '/' . preg_quote($start) . '(.*';
        if (!$greedy) $pattern .= '?';
        $pattern .= ')' . preg_quote($end) . '/';
        preg_match($pattern, $string, $matches);
        $string = $matches[0];
        if ($trim) {
            $string = substr($string, strlen($start));
            $string = substr($string, 0, -strlen($start) + 1);
        }
        return $string;
    }

    function in_arrayi($needle, $haystack) {
        return in_array(strtolower($needle), array_map('strtolower', $haystack));
    }

}
