<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        // Run the attendance fetch command every 5 minutes
        $schedule->command('attendance:fetch')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }

    protected $commands = [
    \App\Console\Commands\FetchAttendance::class,
];
}
