<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    order: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <div class="w-full mb-4 p-2 border-b border-gray-300 last:border-b-0">
        <div class="flex justify-between w-full">
            <h3 class="text-gray-600 font-bold">
                {{ order.recipe.name }}
            </h3>

            <span>{{ order.status }}</span>
        </div>

        <div class="text-sm text-gray-500">
            Placed at: {{ order.created_at }}
        </div>
    </div>
</template>
