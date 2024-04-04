<?php

namespace App\Contracts;

interface MarketServiceInterface
{
    public function purchaseIngredient(string $name): int;
}
