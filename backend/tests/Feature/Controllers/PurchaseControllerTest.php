<?php

namespace Tests\Feature\Controllers;

use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PurchaseControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_collection_of_purchases(): void
    {
        $this->seed();

        $expectedJson = PurchaseResource::collection(Purchase::with('ingredient')->get())->response()->getData(true)['data'];

        $response = $this->get(route('purchases.index'));

        $response
            ->assertStatus(200)
            ->assertJson($expectedJson);
    }
}
