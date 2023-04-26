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
});
</script>
