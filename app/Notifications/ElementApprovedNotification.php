<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class ElementApprovedNotification extends Notification
{
    public $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function via($notifiable)
    {
        return ['database'];  // Store the notification in the database
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Your element "' . $this->result->step->element->name . '" has been approved!',
            'result_id' => $this->result->id,
        ];
    }

    // If you want to explicitly handle UUIDs, override the `id` method
    public function id()
    {
        // Generate a UUID for the notification
        return (string) Str::uuid();
    }
}
