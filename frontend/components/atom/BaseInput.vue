<template>
    <input :id="id" v-model="value" :type="type" class="border rounded-md border-purple-800 focus:outline-purple-900">
</template>

<script setup>
const value = ref("");

defineProps({
    id: {
        type: String,
        required: true
    },
    type: {
        type: String,
        default: "text"
    },
    errors: {
        type: Array,
        default: []
    }
});

</script>
