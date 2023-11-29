<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserNotif implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pesan;
    public $userId;

    public function __construct($userId, $pesan)
    {
        $this->userId = $userId;
        $this->pesan = $pesan;
    }

    public function broadcastOn() : array
    {
        return [
            'user-notification-' . $this->userId
        ];
    }

    public function broadcastAs()
    {
        return 'user-notification';
    }
}
