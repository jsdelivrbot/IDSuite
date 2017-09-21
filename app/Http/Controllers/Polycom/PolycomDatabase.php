<?php
/**
 * Created by PhpStorm.
 * User: fbreidi
 * Date: 9/20/2017
 * Time: 10:13 AM
 */

namespace App\Http\Controllers\Polycom;


class PolycomDatabase
{

    function insert_cdr($cdr_rows) {

            foreach ($cdr_rows as $cdr_row) {



            $record = new \App\Record();
            $dynamic_enum_value = new \App\DynamicEnumValue();
            $dynamic_enum_value->save();
            $dynamic_enum_value->definition(DatabaseSeeder::$dynamic_enum)->save(DatabaseSeeder::$dynamic_enum);
            $dynamic_enum_value->value = $cdr_row[0];
            $dynamic_enum_value->value_type = \App\Enums\EnumDataSourceType::getKeyByValue('mrge');

            $dynamic_enum_value->save();

            $record->references($dynamic_enum_value);

            $record->save();


            $endpoint_id = $this->endpoint_map[$end_id];
            $endpoint = \App\Endpoint::getObjectById($endpoint_id);

            $timeperiod = new \App\TimePeriod();
            $timeperiod->start = date_create_from_format('m-d-Y g:i A', $cdr_row['start_date']." ".$cdr_row['start_time'])->format('Y-m-d H:i:s');
            $timeperiod->end = date_create_from_format('m-d-Y g:i A', $cdr_row['end_date']." ".$cdr_row['end_time'])->format('Y-m-d H:i:s');
            $timeperiod->save();
            $timeperiod->setDuration();

            $ip2location = \App\Ip2Location::getByIp($remote_number);
            if ($ip2location !== false && $ip2location->latitude !== 0.0 && $ip2location->longitude !== 0.0) {
                $coordinate = new \App\Coordinate();
                $coordinate->lng = $ip2location->longitude;
                $coordinate->lat = $ip2location->latitude;
                $coordinate->save();
                $location = new \App\Location();
                $location->save();
                $location->address = null;
                $location->city = $ip2location->city_name;
                $location->state = $ip2location->region_name;
                $location->zipcode = $ip2location->zip_code;
                $location->country_code = $ip2location->country_code;
                $location->time_zone = $ip2location->time_zone;
                $location->coordinate($coordinate)->save($coordinate);
                $location->save();
                $record->remote_location($location)->save($location);
            } else {
                $record->remote_location($endpoint->location)->save($endpoint->location);
            }

            $record->save();

            $record->timeperiod($timeperiod)->save($timeperiod);
            $record->endpoint($endpoint)->save($endpoint);

            // check and validate with amac
            $record->local_id       = $cdr_row['serial_number'];
            $record->conference_id  = $cdr_row['serial_number'];
            $record->local_name     = $cdr_row['name'];
            $record->local_number   = $cdr_row['call_id'];
            $record->remote_name    = $cdr_row['remote_system_name'];
            $record->remote_number  = $cdr_row['call_number_1'];
            $record->dialed_digits  = $cdr_row['call_number_1'];
            $record->direction      = (strcasecmp ($cdr_row['call_direction'], "incoming") ? "in" : "out");
            $record->protocol       = $cdr_row['transport_type'];

            $record->save();

            $record->process();

            // insert into database END

        }
    }

}