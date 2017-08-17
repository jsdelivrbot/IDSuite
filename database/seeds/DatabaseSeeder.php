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

        $dynamic_enum = new \App\DynamicEnum();

        $dynamic_enum->name = 'reference_key';

        $reference_keys = \App\Enums\EnumDataSourceType::getValues();

        $dynamic_enum->values = json_encode($reference_keys);

        $dynamic_enum->save();

        self::$dynamic_enum = $dynamic_enum;

//        $this->call('ip2LocationSeeder');

        $this->call('EnvironmentSeeder');
        //$this->call('CaseSeeder');
        //$this->call('EndpointSeeder');
       // $this->call('RecordSeeder');
    }
}
