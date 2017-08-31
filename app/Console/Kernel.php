<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        '\App\Console\Commands\GetUpdateCustomers',
        '\App\Console\Commands\GetUpdateEmployees',
        '\App\Console\Commands\GetUpdateSMSites',

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // force to run everytime
       // $schedule->command('Netsuite:updatesmsites');



        // netsuite fetches
        $schedule->command('Netsuite:updateemployees') ->dailyAt("1:00");
        $schedule->command('Netsuite:updatecustomers') ->dailyAt("1:30");
        $schedule->command('Netsuite:updatesmsites') ->dailyAt("3:00");

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
