<?php

namespace Tests\Feature\Services;

use Tests\TestCase;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Http;
use App\Services\AlegraMarketService;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlegraMarketServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_purchase_ingredients_from_market(): void
    {
        $url = Config::get('services.alegra.url');

        $ingredient = 'tomato';

        $expectedQuantity = 5;

        Http::fake([
            "{$url}?ingredient={$ingredient}" => Http::response(['quantitySold' => $expectedQuantity], Response::HTTP_OK)
        ]);

        $marketService = new AlegraMarketService($url);

        $purchasedQuantity = $marketService->purchaseIngredient($ingredient);

        $this->assertEquals($expectedQuantity, $purchasedQuantity);
    }
}
