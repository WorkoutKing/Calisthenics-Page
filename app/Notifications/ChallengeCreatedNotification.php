<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class ChallengeCreatedNotification extends Notification
{
    public $challenge;

    public function __construct($challenge)
    {
        $this->challenge = $challenge;
    }

    // Determine which channels this notification will be sent through
    public function via($notifiable)
    {
        return ['database'];  // Use only the database channel for simplicity
    }

    // Define the data stored in the database
    public function toArray($notifiable)
    {
        return [
            'message' => 'A new challenge has been created: ' . $this->challenge->name,
            'challenge_id' => $this->challenge->id,
            'url' => route('challenges.show', $this->challenge->id), // Add the link to the challenge
        ];
    }
}
