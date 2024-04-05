<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RecipeController extends Controller
{
    public function index(): JsonResponse
    {
        $recipes = Recipe::with('ingredients')->get();

        return response()->json(RecipeResource::collection($recipes), Response::HTTP_OK);
    }
}
