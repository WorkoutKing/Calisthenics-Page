<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class ChallengeDeletedNotification extends Notification
{
    public $challengeResult;

    public function __construct($challengeResult)
    {
        $this->challengeResult = $challengeResult;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Your challenge result for "' . $this->challengeResult->challenge->name . '" has been deleted.',
            'challenge_id' => $this->challengeResult->challenge->id,
        ];
    }
}
