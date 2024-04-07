<?php

namespace App\Events;

use App\Models\Ingredient;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IngredientQuantityUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public readonly Ingredient $ingredient)
    {
    }

    public function broadcastOn(): Channel
    {
        return new Channel('ingredient-quantity-updated');
    }
}
