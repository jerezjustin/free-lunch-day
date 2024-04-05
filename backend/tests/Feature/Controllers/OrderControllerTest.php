<?php

namespace Tests\Feature\Controllers;

use App\Jobs\PrepareMealJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_make_a_new_order(): void
    {
        $this->seed();

        $response = $this->post(route('orders.store'))
            ->assertCreated();

        $order = $response->json();

        $this->assertDatabaseHas('orders', ['id' => $order['id']]);
    }
}
