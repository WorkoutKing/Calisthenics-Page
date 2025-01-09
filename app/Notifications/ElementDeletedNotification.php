<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class ElementDeletedNotification extends Notification
{
    public $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function via($notifiable)
    {
        return ['database'];  // Storing the notification in the database
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Your element "' . $this->result->step->element->name . '" has been deleted.',
            'result_id' => $this->result->id,
        ];
    }
}
