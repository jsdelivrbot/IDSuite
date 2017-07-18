<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // $this->call('ip2LocationSeeder');
        $this->call('NsSeeder');
        $this->call('CaseSeeder');
        $this->call('EndpointSeeder');
        $this->call('RecordSeeder');
    }
}
