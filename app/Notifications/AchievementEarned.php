<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AchievementEarned extends Notification
{
    use Queueable;

    protected $element;

    /**
     * Create a new notification instance.
     *
     * @param $element
     */
    public function __construct($element)
    {
        $this->element = $element;
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
            'element_name' => $this->element->name,
            'message' => "You earned the achievement for completing \"{$this->element->name}\"!",
            'completed_at' => now(),
        ];
    }
}
