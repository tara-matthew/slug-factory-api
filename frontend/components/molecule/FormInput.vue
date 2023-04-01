<template>
  <div>
    <AtomBaseLabel class="block mb-1" :element-id="elementId" :text="text" />
    <AtomBaseInput
      :id="elementId"
      class="px-1 py-1 w-full"
      :type="type"
      :name="elementId"
      :errors="errors"
      @update:modelValue="formInput"
      @input="input"
    />
    <p v-if="errors" class="text-red-800">
      {{ errors[0] }}
    </p>
  </div>
</template>

<script setup lang="ts">
const props = defineProps({
    elementId: String,
    text: String,
    modelValue: String,
    type: String,
    errors: Object
});

const emit = defineEmits(["input", "update:modelValue"]);

function formInput (value, element) {
    // console.log('here', value, element);
    emit("input", value, element);
}

function input (value, element) {
    // console.log('forminput', value, element)
    emit("input", value, element);
}
</script>
