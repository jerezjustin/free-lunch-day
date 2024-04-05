<script setup>
import { useIngredientStore } from '../stores/IngredientStore';
import { usePurchaseStore } from '../stores/PurchaseStore';

import IngredientItem from './IngredientItem.vue';
import PurchaseRecord from './PurchaseRecord.vue';

const ingredientStore = useIngredientStore();
ingredientStore.fetchIngredients();

const purchaseStore = usePurchaseStore();
purchaseStore.fetchPurchases();
</script>

<template>
    <div class="w-1/2 border rounded-lg p-4">
        <!-- Ingredient List -->
        <h2 class="text-xl font-bold text-gray-700 mt-2 mb-4">Available Ingredients</h2>

        <div class="grid grid-cols-5 gap-2">
            <IngredientItem v-for="ingredient in ingredientStore.ingredients" :key="ingredient.id"
                :ingredient="ingredient" />
        </div>

        <!-- Ingredients Purchase History -->
        <h2 class="text-xl font-bold text-gray-700 mt-4 mb-2">Purchase History</h2>

        <div class="flex flex-col">
            <PurchaseRecord v-for="purchase in purchaseStore.purchases" :key="purchase.id" :purchase="purchase" />

            <button v-if="purchaseStore.pagination.nextPage" @click="purchaseStore.loadMore" class="self-center">
                Load more
            </button>
        </div>
    </div>
</template>