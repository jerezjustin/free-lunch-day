<?php

namespace App\Events;

use App\Models\Purchase;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewIngredientPurchase implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public function __construct(public readonly Purchase $purchase)
    {
        $purchase->load('ingredient');
    }

    public function broadcastOn(): Channel
    {
        return new Channel('new-ingredient-purchase');
    }
}
