<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use App\Notifications\InactiveUserNotification;

class NotifyInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:inactive-users 
                            {--days=30 : The number of days to consider a user inactive}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications to users who have been inactive for a specified period';

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
     * @return int
     */
    public function handle()
    {
        $inactiveDays = $this->option('days');
        $thresholdDate = Carbon::now()->subDays($inactiveDays);

        $inactiveUsers = User::where('last_active_at', '<', $thresholdDate)
                            ->where('notified_as_inactive', false)
                            ->get();

        if ($inactiveUsers->isEmpty()) {
            $this->info('No inactive users found.');
            return;
        }

        $this->info("Found {$inactiveUsers->count()} inactive users.");

        $inactiveUsers->each(function ($user) {
            // Send notification
            $user->notify(new InactiveUserNotification());
            
            // Mark as notified to avoid duplicate notifications
            $user->update(['notified_as_inactive' => true]);
            
            $this->info("Notification sent to: {$user->email}");
        });

        $this->info('All notifications sent successfully!');
    }
}
