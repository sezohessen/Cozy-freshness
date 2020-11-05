<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PusherNotify implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $time;
    public $full_name;
    public $created_at;
    public function __construct($time,$full_name,$created_at)
    {
        $this->time = $time;
        $this->full_name = $full_name;
        $this->created_at = $created_at;
    }

    public function broadcastOn()
    {
        return ['notify'];
    }

    public function broadcastAs()
    {
        return 'send-order';
    }
}
