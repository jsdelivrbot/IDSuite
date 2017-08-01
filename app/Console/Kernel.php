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
        '\App\Console\Commands\GetUpdateSalesRep',

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // netsuite fetches
        $schedule->command('GetUpdateEmployees:getemployees') ->dailyAt("3:00");
        $schedule->command('GetUpdateCustomers:getcustomers') ->hourly();
        $schedule->command('GetUpdateSalesRep:getsalesrep') ->everyThirtyMinutes();

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
