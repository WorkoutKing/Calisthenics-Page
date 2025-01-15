<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AchievementEarned extends Notification
{
    use Queueable;

    protected $element;
    protected $step;

    /**
     * Create a new notification instance.
     *
     * @param object $element
     * @param object $step
     */
    public function __construct($element, $step)
    {
        $this->element = $element;
        $this->step = $step;
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
            'step_name' => $this->step->name,
            'message' => "Congratulations! You've earned the achievement for completing \"{$this->element->name}\".",
            'completed_at' => now()->toDateTimeString(),
        ];
    }
}
