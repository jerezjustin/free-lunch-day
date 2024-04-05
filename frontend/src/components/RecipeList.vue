<script setup>
import RecipeCard from './RecipeCard.vue';
import { useRecipeStore } from "../stores/RecipeStore";

const recipeStore = useRecipeStore();
recipeStore.fetchRecipes();
</script>

<template>
    <h2 class="text-xl font-bold text-gray-700 mb-2">Available Recipes</h2>

    <div class="flex flex-wrap gap-2">
        <RecipeCard v-for="recipe in recipeStore.recipes" :key="recipe.id" :recipe="recipe" />
    </div>
</template>