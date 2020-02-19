<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewEvent implements ShouldBroadcastNow // ShouldBroadcastNow - без очереди//  ShouldBroadcast - c очередью ShouldBroadcast - для широковешания //
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // данные для передачи редис сервер
    public $result; // ['result' => 'что нибудь']

    public function __construct($data)
    {
        $this->result = $data;
    }

    // возврашяет массив каналов для котрого массив должен быть широковешательным
    // данные передаемые редис сервер
    public function broadcastOn()
    {
        // название канала
        return ['news-action'];
        // return new PrivateChannel('channel-name');
    }
}
