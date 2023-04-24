<template>
    <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
        {{ text }}
    </button>
</template>

<script setup lang="ts">
defineProps({
    text: {
        type: String,
        required: true
    }
});

// TODO consider using a slot to allow something like a button with an icon
</script>
