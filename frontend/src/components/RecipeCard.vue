<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    recipe: {
        type: Object,
        required: true
    }
});

const formattedIngredients = () => {
    return props.recipe.ingredients.map((ingredient) => `${ingredient.quantity} ${ingredient.name}`).join(', ');
}
</script>

<template>
    <div class="w-full sm:w-auto flex flex-wrap flex-col border p-4 rounded-lg">
        <h3 class="text-gray-600 font-bold mb-2">{{ recipe.name }}</h3>
        <p class="text-sm">{{ formattedIngredients() }}.</p>
    </div>
</template>