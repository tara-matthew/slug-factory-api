<template>
    <input :type="type" :value="modelValue" :id="id" class="border rounded-md border-purple-800 focus:outline-purple-900" />
</template>

<script setup>
const emit = defineEmits(['input', 'update:modelValue'])
const { $event } = useNuxtApp()

const props = defineProps({
  id: String,
  modelValue: String,
  type: String
});
// function updateValue(value, id) {
//   // console.log('base input', value, id);
//   emit('input', value, id)
// }

// function inputUpdated(value, element) {
//   console.log('event bus', element, value)
//   $event('input-updated', value, element)
// }
</script>
