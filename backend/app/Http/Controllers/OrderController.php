<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Recipe;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function __construct(private readonly OrderService $orderService)
    {
    }

    public function index(): JsonResponse
    {
        $orders = $this->orderService->getPaginated();

        $orders->load(['recipe.ingredients']);

        return response()->json(OrderResource::collection($orders)->response()->getData(true), Response::HTTP_OK);
    }

    public function store(): JsonResponse
    {
        try {
            $recipe = Recipe::with('ingredients')->inRandomOrder()->first();

            $order = $this->orderService->process($recipe);

            $order->load('recipe.ingredients');

            return response()->json(new OrderResource($order), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            Log::error("{$e->getMessage()} on file {$e->getFile()}:{$e->getLine()}");

            return response()->json(
                [
                    'message' => 'Failed to process order',
                    'error' => $e->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
