<template>
    <component :is="tag">
        {{ content }}
    </component>
</template>

<script setup lang="ts">
defineProps({
    tag: {
        type: String, // Make this an enum
        required: true
    },
    content: {
        type: String,
        required: true
    }

});

</script>
