<?php

namespace App\Services;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Collection;

class IngredientService
{
    public function getAll(): Collection
    {
        return Ingredient::all();
    }

    public function updateQuantity(Ingredient $ingredient, int $quantity): void
    {
        $ingredient->quantity = $quantity;

        $ingredient->save();
    }
}
