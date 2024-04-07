<script setup>
import { onMounted } from 'vue';
import { useOrderStore } from '../stores/OrderStore';
import OrderRecord from './OrderRecord.vue';

const orderStore = useOrderStore();
orderStore.fetchOrders();

onMounted(() => {
    window.Echo.channel('order-status-updated').listen('OrderStatusUpdated', (e) => {
        orderStore.updateOrder(e.order);
    });
});
</script>

<template>
    <div class="w-1/2 flex flex-col border rounded-lg p-4 self-start">
        <button @click="orderStore.placeOrder"
            class="self-end bg-red-500 text-white px-4 py-2 rounded-lg font-bold mb-8">
            Place Order
        </button>

        <div class="flex justify-between">
            <h2 class="text-xl font-bold text-gray-700 mt-2 mb-4">Order History</h2>

            <div class="flex gap-2">
                <button @click="orderStore.fetchOrders()" class="text-sm text-gray-500">All</button>
                <button @click="orderStore.fetchOrders('completed')" class="text-sm text-gray-500">Complete</button>
                <button @click="orderStore.fetchOrders('pending')" class="text-sm text-gray-500">Pending</button>
                <button @click="orderStore.fetchOrders('preparing')" class="text-sm text-gray-500">Preparing</button>
                <button @click="orderStore.fetchOrders('failed')" class="text-sm text-gray-500">Failed</button>
            </div>
        </div>

        <div class="flex flex-col">
            <OrderRecord v-for="order in orderStore.orders" :key="order.id" :order="order" />

            <button v-if="orderStore.pagination.nextPage" @click="orderStore.loadMore" class="self-center">
                Load more
            </button>
        </div>
    </div>
</template>