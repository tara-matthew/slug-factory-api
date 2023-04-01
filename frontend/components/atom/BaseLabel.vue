<template>
    <label :for="elementId" class="text-gray-600"> {{ text }}</label>
</template>

<script setup lang="ts">
defineProps({
    elementId: String,
    text: String
});
</script>
