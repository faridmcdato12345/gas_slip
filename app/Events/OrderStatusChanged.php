<?php

namespace App\Events;

use App\Application;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderStatusChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $application;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new Channel('pizza-tracker');
        return ['private-pizza-tracker.'.$this->application->id, 'pizza-tracker'];
    }

    public function broadcastWith()
    {
        $extra = [
            'applicant_name' => $this->application->applicant->name,
        ];

        return array_merge($this->application->toArray(), $extra);
    }
}