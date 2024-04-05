<?php

namespace App\Services;

use App\Models\Purchase;
use App\Models\Ingredient;

class PurchaseService
{
    public function store(Ingredient $ingredient, int $quantity): Purchase
    {
        return Purchase::create(['ingredient_id' => $ingredient->getKey(), 'quantity' => $quantity,]);
    }
}
