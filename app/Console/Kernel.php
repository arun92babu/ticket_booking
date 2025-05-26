<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('notify:inactive-users --days=30')
                 ->dailyAt('00:00')
                 ->timezone('UTC') // or your preferred timezone
                 ->onSuccess(function () {
                     // Optional: Log success or send notification
                     \Log::info('Inactive users notified successfully at ' . now());
                 })
                 ->onFailure(function () {
                     // Optional: Log failure or send alert
                     \Log::error('Failed to notify inactive users at ' . now());
                 });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    protected $commands = [
        \App\Console\Commands\NotifyInactiveUsers::class,
    ];
}
