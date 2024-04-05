<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    purchase: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <div class="flex justify-between w-full mb-4 p-2 border-b border-gray-300 last:border-b-0">
        <h3 class="text-gray-600 font-bold">
            {{ purchase.quantity }} {{ purchase.ingredient.name }}
        </h3>

        <span class="text-sm text-gray-500">{{ purchase.created_at }}</span>
    </div>
</template>
