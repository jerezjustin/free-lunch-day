<?php

namespace App\Http\Controllers;

use App\Http\Resources\IngredientResource;
use App\Services\IngredientService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class IngredientController extends Controller
{
    public function __construct(private readonly IngredientService $ingredientService)
    {
    }

    public function index(): JsonResponse
    {
        $ingredients = $this->ingredientService->getAll();

        return response()->json(IngredientResource::collection($ingredients), Response::HTTP_OK);
    }
}
