<?php

namespace App\Jobs;

use App\Contracts\MarketServiceInterface;
use App\Enums\OrderStatus;
use App\Models\Ingredient;
use App\Models\Order;
use App\Models\Recipe;
use App\Services\AlegraMarketService;
use App\Services\IngredientService;
use App\Services\OrderService;
use App\Services\PurchaseService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PrepareMealJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    public $backoff = 5;
    public $maxExceptions = 5;

    protected MarketServiceInterface $marketService;
    protected OrderService $orderService;
    protected IngredientService $ingredientService;
    protected PurchaseService $purchaseService;


    public function __construct(protected Recipe $recipe, protected Order $order)
    {
        $this->recipe->load('ingredients');

        $this->marketService = new AlegraMarketService(config('services.alegra.url'));

        $this->orderService = new OrderService();

        $this->ingredientService = new IngredientService();

        $this->purchaseService = new PurchaseService();
    }

    public function handle(): void
    {
        DB::beginTransaction();

        try {
            $this->orderService->updateStatus($this->order, OrderStatus::Preparing);
            $this->prepareMeal();
            $this->orderService->updateStatus($this->order, OrderStatus::Completed);
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            $this->orderService->updateStatus($this->order, OrderStatus::Failed);
        }
    }

    public function prepareMeal(): void
    {
        foreach ($this->recipe->ingredients as $ingredient) {
            $quantity = $ingredient->pivot->quantity;

            if ($ingredient->quantity < $quantity) {
                $this->purchaseIngredient($ingredient, $quantity);
            }

            $this->ingredientService->updateQuantity($ingredient, $ingredient->quantity - $quantity);
        }
    }

    public function purchaseIngredient(Ingredient $ingredient, int $quantity): void
    {
        $attempts = 0;

        while ($ingredient->quantity < $quantity && $attempts < 5) {
            $purchasedQuantity = $this->marketService->purchaseIngredient($ingredient->name);

            if ($purchasedQuantity > 0) {
                $ingredient->quantity += $purchasedQuantity;
                $this->purchaseService->store($ingredient, $purchasedQuantity);
            }

            $attempts++;
        }

        if ($ingredient->quantity < $quantity) {
            throw new \Exception('Failed to purchase enough ingredients to prepare meal.');
        }
    }
}
