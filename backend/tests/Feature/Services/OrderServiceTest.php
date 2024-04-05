<?php

namespace Tests\Feature\Services;

use App\Enums\OrderStatus;
use App\Jobs\PrepareMealJob;
use App\Models\Order;
use App\Models\Recipe;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_can_process_a_new_order_for_a_recipe(): void
    {
        Queue::fake();

        $recipe = Recipe::inRandomOrder()->first();

        $orderService = new OrderService();

        $order = $orderService->process($recipe);

        $this->assertDatabaseHas('orders', $order->toArray());

        Queue::assertPushed(PrepareMealJob::class);
    }

    public function test_can_update_order_status(): void
    {
        $recipe = Recipe::inRandomOrder()->first();

        $orderService = new OrderService();

        $order = $orderService->process($recipe);

        $orderService->updateStatus($order, $updatedStatus = OrderStatus::Preparing);

        $this->assertTrue($order->status === $updatedStatus);
    }
}
