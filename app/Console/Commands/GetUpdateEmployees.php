<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
class GetUpdateEmployees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GetUpdateEmployees:getemployees';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get and update all employees fetched from netsuite';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
