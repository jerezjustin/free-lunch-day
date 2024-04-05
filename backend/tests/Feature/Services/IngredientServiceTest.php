<?php

namespace Tests\Feature\Services;

use App\Models\Ingredient;
use App\Services\IngredientService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IngredientServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_can_update_ingredient_quantity(): void
    {
        $ingredient = Ingredient::inRandomOrder()->first();

        $ingredientService = new IngredientService();

        $ingredientService->updateQuantity($ingredient, $updatedQuantity = 10);

        $this->assertTrue($ingredient->quantity === $updatedQuantity);
    }
}
