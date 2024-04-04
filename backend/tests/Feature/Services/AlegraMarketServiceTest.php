<?php

namespace Tests\Feature\Services;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Services\AlegraMarketService;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class AlegraMarketServiceTest extends TestCase
{
    public function test_can_purchase_ingredients_from_market(): void
    {
        $url = Config::get('services.alegra.url');

        $ingredient = 'chicken';

        $expectedQuantity = 5;

        Http::fake([
            "{$url}?ingredient={$ingredient}" => Http::response(['quantitySold' => $expectedQuantity], Response::HTTP_OK)
        ]);

        $marketService = new AlegraMarketService($url);

        $purchasedQuantity = $marketService->purchaseIngredient($ingredient);

        $this->assertEquals($expectedQuantity, $purchasedQuantity);
    }
}
