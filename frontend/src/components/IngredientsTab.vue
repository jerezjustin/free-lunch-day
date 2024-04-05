<script setup>
import { useIngredientStore } from '../stores/IngredientStore';
import IngredientItem from './IngredientItem.vue';

const ingredientStore = useIngredientStore();
ingredientStore.fetchIngredients();
</script>

<template>
    <div class="w-1/2 border rounded-lg p-4">
        <!-- Ingredient List -->
        <div class="grid grid-cols-5 gap-2">
            <IngredientItem v-for="ingredient in ingredientStore.ingredients" :key="ingredient.id"
                :ingredient="ingredient" />
        </div>
    </div>
</template>