<template>
    <label :for="elementId" class="text-gray-600"> {{ text }}</label>
</template>

<script setup lang="ts">
defineProps({
    elementId: {
        type: String,
        required: true
    },
    text: {
        type: String,
        required: true
    }
});
</script>
