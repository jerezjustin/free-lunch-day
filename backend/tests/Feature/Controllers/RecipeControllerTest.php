<?php

namespace Tests\Feature\Controllers;

use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecipeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_collection_of_recipes(): void
    {
        $this->seed();

        $expectedJson = RecipeResource::collection(Recipe::with('ingredients')->get())->response()->getData(true)['data'];

        $response = $this->get(route('recipes.index'));

        $response
            ->assertStatus(200)
            ->assertJson($expectedJson);
    }
}
