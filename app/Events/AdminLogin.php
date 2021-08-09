<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdminLogin
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $name;

    protected $ip;

    protected $type;

    protected $msg;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($name,$ip,$type,$msg)
    {
        $this->name = $name;
        $this->ip = $ip;
        $this->type = $type;
        $this->msg = $msg;
    }

    public function getUserName()
    {
        return $this->name;
    }

    public function getUserIp()
    {
        return $this->ip;
    }

    public function getLoginType()
    {
        return $this->type;
    }

    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
