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
        Commands\CompanySeed::class,
        Commands\BillReminder::class,
        Commands\InvoiceReminder::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Not installed yet
        if (env('DB_DATABASE', '') == '') {
            return;
        }

        $schedule->command('reminder:invoice')->dailyAt(setting('general.schedule_time', '09:00'));
        $schedule->command('reminder:bill')->dailyAt(setting('general.schedule_time', '09:00'));
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
