<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BasicApprovedNotification extends Notification
{
    use Queueable;

    protected $basic;

    public function __construct($basic)
    {
        $this->basic = $basic;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Your upload for {$this->basic->exercise} has been approved!",
        ];
    }
}

