<template>
    <div class="bg-white rounded-lg overflow-hidden shadow-md">
        <div class="px-4 py-2 flex-grow">
            <div v-if="slots.image" class="mb-3">
                <slot name="image" />
            </div>
            <div class="text-lg font-bold mb-2 overflow-hidden whitespace-nowrap" style="height:60px;">
                <slot name="title" />
            </div>
            <div class="h-24 overflow-scroll">
                <slot name="content" />
            </div>
        </div>
        <div class="px-4 py-2 bg-gray-100">
            <slot name="footer" />
        </div>
    </div>
</template>

<script setup>
import { useSlots } from "vue";
const slots = useSlots();
</script>
