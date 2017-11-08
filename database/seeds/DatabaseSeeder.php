<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public static $dynamic_enum;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::$dynamic_enum = \App\DynamicEnum::getByName('reference_key');

//        $this->call('ip2LocationSeeder');

//        $this->call('EnvironmentSeeder');
        $this->call('CaseSeeder');
        $this->call('EndpointSeeder');
//        $this->call('RecordSeeder');
    }
}
