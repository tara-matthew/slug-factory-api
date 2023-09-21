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

const columnClasses = ref({
    3: "grid-cols-3",
    4: "grid-cols-4",
    5: "grid-cols-5"
});

const gridClasses = computed(() => {
    // Tailwind has issues with dynamic classes https://stackoverflow.com/questions/70579947/vue-application-styled-with-tailwindcss-ignores-a-grid-with-4-columns-but-works //
    return columnClasses.value[props.columns as keyof typeof columnClasses.value];
});
</script>
