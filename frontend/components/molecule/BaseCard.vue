<template>
    <div class="bg-white rounded-lg overflow-hidden shadow-md">
        <div class="px-4 py-2">
            <div v-if="slots.image" class="mb-3">
                <slot name="image" />
            </div>
            <div class="text-lg font-bold mb-2" style="height:50px;">
                <slot name="title" />
            </div>
            <div class="h-16">
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
