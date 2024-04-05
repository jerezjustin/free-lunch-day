<script setup>
import IngredientsTab from './components/IngredientsTab.vue';
import RecipeList from './components/RecipeList.vue';
</script>

<template>
  <div class="px-3 sm:px-6 min-h-full py-20">
    <div class="max-w-7xl mx-auto">
      <h1 class="text-4xl font-bold text-gray-900 mb-8">Free Lunch Day 🍚🍗😋!</h1>

      <!-- Recipe List -->
      <RecipeList />

      <!-- Tabs Container -->
      <div class="flex mt-8">
        <IngredientsTab />
      </div>
    </div>
  </div>
</template>
