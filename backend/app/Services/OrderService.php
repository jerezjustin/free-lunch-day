<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Recipe;
use App\Enums\OrderStatus;
use App\Jobs\PrepareMealJob;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderService
{
    public function getPaginated(int $perPage = 10): LengthAwarePaginator
    {
        $orders = Order::query();

        if (request()->has('status') && $status = OrderStatus::tryFrom(request()->query('status'))) {
            $orders->status($status);
        }

        $orders->latest();

        return $orders->paginate($perPage);
    }

    public function process(Recipe $recipe): Order
    {
        $order = $recipe->orders()->create(['status' => OrderStatus::Pending]);

        PrepareMealJob::dispatch($recipe, $order);

        return $order;
    }

    public function updateStatus(Order $order, OrderStatus $status): void
    {
        $order->status = $status;

        $order->save();
    }
}
