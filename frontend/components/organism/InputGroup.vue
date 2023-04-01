<template>
  <div>
    <MoleculeFormInput
      v-for="input in inputs"
      :key="input.elementId"
      :text="input.text"
      :element-id="input.elementId"
      :type="input.type"
      :errors="errors[input.elementId]"
      class="mb-7"
      @input="formInput"
    />
  </div>
</template>

<script setup lang="ts">
import { PropType } from "vue";
import { FormInput } from "~/types/FormInput";

defineProps({
    inputs: {
        type: Array as PropType<FormInput[]>,
        required: true
    },
    errors: Object
});

const emit = defineEmits(["input", "update:modelValue"]);

function formInput (value, element) {
    // console.log('inputGroup', value, element)
    emit("input", value, element);
}

</script>
