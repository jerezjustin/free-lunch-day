<?php

namespace App\Services;

use App\Contracts\MarketServiceInterface;
use Illuminate\Support\Facades\Http;

class AlegraMarketService implements MarketServiceInterface
{
    public function __construct(protected string $url)
    {
    }

    public function purchaseIngredient(string $ingredient): int
    {
        $response = Http::get($this->url, ['ingredient' => strtolower($ingredient)]);

        if (!$response->successful()) {
            throw new \Exception('Failed to purchase ingredient: ' . $ingredient);
        }

        return $response->json('quantitySold');
    }
}
