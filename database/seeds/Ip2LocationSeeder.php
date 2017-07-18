<?php

use Illuminate\Database\Seeder;


class Ip2LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->processLocations();

    }

    public function processLocations()
    {

        dump("opening file..");

        $handle = fopen('ip2location.csv', "r");
        $header = true;

        while ($csvLine = fgetcsv($handle, 1000, ",")) {

            if ($header) {
                $header = false;
            } else {

                $ip2location = new \App\Ip2Location();


                $ip2location->ip_from = $csvLine[0];
                $ip2location->ip_to = $csvLine[1];
                $ip2location->country_code = $csvLine[2];
                $ip2location->country_name = $csvLine[3];
                $ip2location->region_name = $csvLine[4];
                $ip2location->city_name = $csvLine[5];
                $ip2location->latitude = $csvLine[6];
                $ip2location->longitude = $csvLine[7];
                $ip2location->zip_code = $csvLine[8];
                $ip2location->time_zone = $csvLine[9];

                $ip2location->save();




            }
        }

        dump('end of ip2location seeder');




    }
}
