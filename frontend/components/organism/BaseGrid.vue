<template>
    <div :class="gridClasses" class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
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
