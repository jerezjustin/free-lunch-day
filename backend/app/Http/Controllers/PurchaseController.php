<?php

namespace App\Http\Controllers;

use App\Http\Resources\PurchaseResource;
use App\Services\PurchaseService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PurchaseController extends Controller
{
    public function __construct(private readonly PurchaseService $purchaseService)
    {
    }

    public function index(): JsonResponse
    {
        $purchases = $this->purchaseService->getPaginated();

        return response()->json(PurchaseResource::collection($purchases)->response()->getData(true), Response::HTTP_OK);
    }
}
