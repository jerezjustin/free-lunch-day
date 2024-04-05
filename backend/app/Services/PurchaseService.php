<?php

namespace App\Services;

use App\Models\Purchase;
use App\Models\Ingredient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PurchaseService
{
    public function getPaginated(int $perPage = 10): LengthAwarePaginator
    {
        $purchases = Purchase::query();

        if (request()->has('ingredient_id')) {
            $purchases->where('ingredient_id', request()->query('ingredient_id'));
        }

        $purchases->latest();

        return $purchases->paginate($perPage);
    }

    public function store(Ingredient $ingredient, int $quantity): Purchase
    {
        return Purchase::create(['ingredient_id' => $ingredient->getKey(), 'quantity' => $quantity,]);
    }
}
