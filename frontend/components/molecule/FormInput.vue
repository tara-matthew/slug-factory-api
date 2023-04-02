<template>
    <div>
        <AtomBaseLabel class="block mb-1" :element-id="elementId" :text="text" />
        <AtomBaseInput
            :id="elementId"
            class="px-1 py-1 w-full"
            :type="type"
            :name="elementId"
            :errors="errors"
        />
        <p v-if="errors" class="text-red-800">
            {{ errors[0] }}
        </p>
    </div>
</template>

<script setup lang="ts">
defineProps({
    elementId: {
        type: String,
        required: true
    },
    text: {
        type: String,
        required: true
    },
    type: {
        type: String,
        default: "text"
    },
    errors: {
        type: Array,
        required: false,
        default: undefined
    }
});
</script>
