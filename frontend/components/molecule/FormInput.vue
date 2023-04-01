<template>
  <div>
    <AtomBaseLabel class="block mb-1" :element-id="elementId" :text="text" />
    <AtomBaseInput v-on:update:modelValue="formInput" @input="input" class="px-1 py-1 w-full" :id="elementId" :type="type" :v-model="elementId" :name="elementId" />
  </div>
</template>

<script setup lang="ts">
const props = defineProps({
  elementId: String,
  text: String,
  modelValue: String,
  type: String
});

const emit = defineEmits(['input', 'update:modelValue'])

function formInput(value, element)
{
  // console.log('here', value, element);
  emit('input', value, element)

}

function input(value, element)
{
  // console.log('forminput', value, element)
  emit('input', value, element)
}
</script>
