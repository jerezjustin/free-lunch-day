<?php

namespace App\Services;

use App\Models\Ingredient;

class IngredientService
{
    public function updateQuantity(Ingredient $ingredient, int $quantity): void
    {
        $ingredient->quantity = $quantity;

        $ingredient->save();
    }
}
