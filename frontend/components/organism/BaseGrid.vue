<template>
    <div :class="gridClasses" class="grid gap-3">
        <slot />
    </div>
</template>

<script setup lang="ts">
const props = defineProps({
    columns: {
        type: Number,
        default: 4
    }
});

const gridClasses = computed(() => {
    return `grid-cols-${props.columns}`; // TODO some responsive classes with different cols depending on screen size
    // Tailwind will have issues with dynamic classes https://stackoverflow.com/questions/70579947/vue-application-styled-with-tailwindcss-ignores-a-grid-with-4-columns-but-works //
});
</script>
