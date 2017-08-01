<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
class GetUpdateSalesRep extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GetUpdateSalesRep:getsalesrep';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get and update all sales representative for x customers.';

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
