<?php

namespace Tests\Feature\Controllers;

use App\Http\Resources\IngredientResource;
use App\Models\Ingredient;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IngredientControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_collection_of_ingredients(): void
    {
        $this->seed();

        $expectedJson = IngredientResource::collection(Ingredient::all())->response()->getData(true)['data'];

        $response = $this->get(route('ingredients.index'));

        $response
            ->assertStatus(200)
            ->assertJson($expectedJson);
    }
}
