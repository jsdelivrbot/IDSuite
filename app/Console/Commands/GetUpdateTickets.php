<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Netsuite;


use DB;
class GetUpdateTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Netsuite:updatetickets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get and update all tickets fetched from netsuite';

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
        $service = Netsuite\NetsuiteDatabase::AddUpdateAllTickets();

    }
}
