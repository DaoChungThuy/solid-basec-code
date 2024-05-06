<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ToDo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ToDo\TaskExpirationNotification;

class SendTaskExpirationNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:notify-expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications for tasks nearing expiration';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tasks = ToDo::where('end_time', '=', Carbon::now()->subMinute()->format('Y-m-d H:i'))->get();

        foreach ($tasks as $task) {
            $userEmail = $task->user->email;
            $task->status = 3;
            $task->save();

            Mail::to($userEmail)
                ->send(new TaskExpirationNotification($task));
        }

        $this->info('Task expiration notifications sent successfully.');
        return Command::SUCCESS;
    }
}
