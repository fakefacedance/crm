<?php

namespace App\Notifications;

use App\Models\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class TaskNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    public string $taskTitle;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $taskTitle)
    {
        $this->taskTitle = $taskTitle;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'type' => 'taskNotification',
            'employeeName' => Employee::find($notifiable->id)->full_name,
            'taskTitle' => $this->taskTitle,
        ]);
    }
}
