<?php

namespace Tests\Feature\Services;

use App\Models\Ingredient;
use App\Services\PurchaseService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_can_create_a_purchase_record(): void
    {
        $ingredient = Ingredient::inRandomOrder()->first();

        $purchaseService = new PurchaseService();

        $purchase = $purchaseService->store($ingredient, 5);

        $this->assertDatabaseHas('purchases', ['id' => $purchase->id]);
    }
}
