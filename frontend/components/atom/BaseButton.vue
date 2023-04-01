<template>
  <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded" @click="$emit('button-clicked', $event)">
    {{ text }}
  </button>
</template>

<script setup lang="ts">
defineProps({
    text: String
});
// const emit = defineEmits(['clicked'])

</script>
