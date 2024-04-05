<script setup>
import { useOrderStore } from '../stores/OrderStore';
import OrderRecord from './OrderRecord.vue';

const orderStore = useOrderStore();
orderStore.fetchOrders();
</script>

<template>
    <div class="w-1/2 flex flex-col border rounded-lg p-4 self-start">
        <button @click="orderStore.placeOrder"
            class="self-end bg-red-500 text-white px-4 py-2 rounded-lg font-bold mb-8">
            Place Order
        </button>

        <h2 class="text-xl font-bold text-gray-700 mt-2 mb-4">Order History</h2>

        <div class="flex flex-col">
            <OrderRecord v-for="order in orderStore.orders" :key="order.id" :order="order" />

            <button v-if="orderStore.pagination.nextPage" @click="orderStore.loadMore" class="self-center">
                Load more
            </button>
        </div>
    </div>
</template>