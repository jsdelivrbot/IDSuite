<?php

use Illuminate\Database\Seeder;

/**
 * Class EnviromentSeeder
 *
 * Initialize the database with information and settings to make the application functional
 */
class EnvironmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        // create default dynamic enum datasource type
        $dynamic_enum = new \App\DynamicEnum();
        $dynamic_enum->name = 'reference_key';
        $reference_keys = \App\Enums\EnumDataSourceType::getValues();
        $dynamic_enum->values = json_encode($reference_keys);
        $dynamic_enum->save();

        // more initializations to follow


        echo ("** EnvironmentSeeder done **\r\n");
    }
}
