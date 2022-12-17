<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Notifications\TaskNotification;
use Illuminate\Console\Command;

class TaskReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отправить работникам напоминания о задачах';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tasks = Task::where('is_completed', false)->get()->filter(function ($value, $key) {
            return isset($value->remind_at) && now()->diffInMinutes($value->remind_at) === 0 && now()->lessThan($value->remind_at);
        });

        foreach ($tasks as $task) {
            $task->executor->notify(new TaskNotification($task->title));
        }

        return Command::SUCCESS;
    }
}
