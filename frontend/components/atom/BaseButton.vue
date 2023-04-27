<template>
    <component
        :is="componentToShow"
        :to="to"
        class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded font-bold w-full block text-center cursor-pointer"
    >
        {{ text }}
    </component>
</template>

<script setup lang="ts">
const componentToShow = computed(() => {
    return props.componentType === "button" ? "button" : resolveComponent("NuxtLink"); // TODO use an enum/constant
});
const props = defineProps({
    text: {
        type: String,
        required: true
    },
    to: {
        type: String || null,
        default: null
    },
    componentType: {
        type: String,
        default: "button"
    }
});

// TODO consider using a slot to allow something like a button with an icon
</script>
