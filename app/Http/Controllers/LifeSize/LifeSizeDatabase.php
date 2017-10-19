<?php
/**
 * Created by PhpStorm.
 * User: fbreidi
 * Date: 9/20/2017
 * Time: 11:15 AM
 */

namespace App\Http\Controllers\LifeSize;


class LifeSizeDatabase
{


//=====================================================================================
// Insert CDR log from lifesize endpoints into database.
// Accepts a CDR_DELIMETER delimited string
//=====================================================================================
    function cdr_insert_lifesize($del_str, $endpoint, $name){


        $dbh = db_connect();

        // Get the most recent sync time for this device, used in comparisons later
        $query = "SELECT start_time FROM cdr_log WHERE endpoint_id = ". intval($endpoint) . " ORDER BY start_time DESC LIMIT 1";
        $res = db_query($query, $dbh);

        if(db_num_rows($res)){
            $ar = db_fetch_assoc($res);
            $last_sync = $ar['start_time'];
        } else {
            // Never synced this endpoint before, arbitrary date/time from the past
            $last_sync = "10-10-1910 10:10:10";
        }

        // Loop through each line of the delimited text
        $rows = explode("\n", trim($del_str));
        for ($i=0; $i<count($rows); $i++) {

            // Split this row into columns, store in array
            if(isset($f)){unset($f);}
            $f = explode(CDR_DELIMETER, trim($rows[$i]));

            // Lets convert the array to associative to make our code a little more readable
            // Suppress warning output here because half of these end up empty on failed calls
            // and there is no benefit to storing an 'unknown' value for most of them, null is fine
            if(isset($f[1])){
                @$f['local_id']      = trim($f[0]);
                @$f['conf_id']       = trim($f[1]);
                @$f['local_name']    = trim($f[2]);
                @$f['local_number']  = trim($f[3]);
                @$f['remote_name']   = trim($f[4]);
                @$f['remote_number'] = trim($f[5]);
                @$f['dialed_digits'] = trim($f[6]);
                @$f['start_time']    = trim($f[7]);
                @$f['duration']      = trim($f[8]);

                // Direction and protocol are a little special
                if(isset($f[9])){$f['direction'] = trim($f[9]);}  else {$f['direction'] = 'unknown';}
                if(isset($f[10])){$f['protocol'] = trim($f[10]);} else {
                    if(strstr(strtolower($f['dialed_digits']), "sip")){
                        $f['protocol'] = 'SIP';
                    } else {
                        $f['protocol'] = "H.323";
                    }
                }

                // TODO: Optimize/re-structure this
                // Calculate end time based on start time and duration
                if(valid_time($f['start_time']) && valid_time($f['duration'])){
                    if($f['duration'] != "" && $f['start_time'] != "0000-00-00 00:00:00"){
                        if($f['duration'] == "00:00:00" || $f['duration'] == "0:0:0"){
                            $f['end_time'] = $f['start_time'];
                        } else {
                            $date = new DateTime($f['start_time']);
                            $date->add(new DateInterval(create_interval($f['duration'])));
                            $f['end_time'] = $date->format('Y-m-d H:i:s');

                            // Last ditch effort to fix blank end time
                            if($f['end_time'] == "0000-00-00 00:00:00" || $f['end_time'] == ""){
                                $f['end_time'] = date("Y-m-d", strtotime($f['start_time']));
                            }
                        }
                    } else {
                        $f['end_time'] = "0000-00-00 00:00:00";
                    }
                } else {
                    $f['end_time'] = "0000-00-00 00:00:00";
                }

                // All else failed.  Save us from inserting bad times
                if(strstr($f['start_time'], "1969")){
                    $f['start_time'] = "";
                    $f['end_time'] = "";
                }
            }

            // Don't want incomplete records
            if(isset($f['conf_id'])){

                // Skip insertion on records without a good time
                if($f['start_time'] == ""){continue;}

                // Make sure we don't already have this record
                if(strtotime($last_sync) < strtotime($f['start_time'])){

                    // Insert
                    $cdr_query = "
                        INSERT INTO cdr_log (
                            `row_stamp`,
                            `conf_id`,
                            `endpoint_id`,
                            `local_id`,
                            `local_name`,
                            `local_number`,
                            `remote_name`,
                            `remote_number`,
                            `dialed_digits`,
                            `start_time`,
                            `end_time`,
                            `duration`,
                            `direction`,
                            `protocol`
                        ) VALUES (
                            NOW(),
                            ". intval($f['conf_id']) .",
                            ". intval($endpoint) .",
                            ". intval($f['local_id']) .",
                            '". db_escape($f['local_name'], $dbh) ."',
                            '". db_escape($f['local_number'], $dbh) ."',
                            '". db_escape($f['remote_name'], $dbh) ."',
                            '". db_escape($f['remote_number'], $dbh) ."',
                            '". db_escape($f['dialed_digits'], $dbh) ."',
                            '". db_escape($f['start_time'], $dbh) ."',
                            '". db_escape($f['end_time'], $dbh) ."',
                            '". db_escape($f['duration'], $dbh) ."',
                            '". db_escape($f['direction'], $dbh) ."',
                            '". db_escape($f['protocol'], $dbh) ."'
                        );
                    ";

                    $cdr_res = db_query($cdr_query, $dbh);

                }

            }
        }

        // Update 'last_update' column for this device in database
        $query = "UPDATE endpoint SET last_update = NOW() WHERE id = ". intval($endpoint);
        $res = db_query($query, $dbh);

        // Log this transaction
        $message = "Synced CDRs for ". $name;
        log_append($endpoint, $message, 'action');

        return true;

    }



}