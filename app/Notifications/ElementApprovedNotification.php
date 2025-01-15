<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ElementApprovedNotification extends Notification
{
    use Queueable;

    protected $result;

    /**
     * Create a new notification instance.
     *
     * @param object $result
     */
    public function __construct($result)
    {
        $this->result = $result;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => "Your result for \"{$this->result->step->name}\" has been approved!",
            'approved_at' => now()->toDateTimeString(),
        ];
    }
}
