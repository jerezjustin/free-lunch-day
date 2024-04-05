<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientAndRecipeSeeder extends Seeder
{
    private const RECIPES = [
        'Stewed Chicken' => [
            'Chicken' => 2,
            'Tomato' => 1,
            'Onion' => 1,
            'Potato' => 1,
            'Rice' => 1
        ],
        'Potato Salad' => [
            'Potato' => 2,
            'Onion' => 1,
            'Lemon' => 1,
            'Lettuce' => 1
        ],
        'Chicken with Rice' => [
            'Chicken' => 1,
            'Rice' => 1,
            'Tomato' => 1,
            'Onion' => 1
        ],
        'Potato Casserole' => [
            'Potato' => 2,
            'Meat' => 1,
            'Tomato' => 1,
            'Cheese' => 1
        ],
        'Chicken Salad' => [
            'Chicken' => 2,
            'Lettuce' => 1,
            'Tomato' => 1,
            'Onion' => 1,
            'Lemon' => 1
        ],
        'Fried Chicken and French Fries' => [
            'Chicken' => 2,
            'Potato' => 1,
            'Ketchup' => 1,
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::RECIPES as $recipeName => $ingredients) {
            $recipe = Recipe::create(['name' => $recipeName]);

            foreach ($ingredients as $ingredientName => $quantity) {
                $ingredient = Ingredient::where('name', $ingredientName)->first();

                if (!$ingredient) {
                    $ingredient = Ingredient::create(['name' => $ingredientName, 'quantity' => 5]);
                }

                $recipe->ingredients()->attach($ingredient->id, ['quantity' => $quantity]);
            }
        }
    }
}
