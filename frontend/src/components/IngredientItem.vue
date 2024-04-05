<script setup>
const props = defineProps({
    ingredient: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <div class="flex flex-col items-center">
        <span>{{ ingredient.quantity }}</span>
        <h3 class="text-gray-600 font-bold mb-2">{{ ingredient.name }}</h3>
    </div>
</template>