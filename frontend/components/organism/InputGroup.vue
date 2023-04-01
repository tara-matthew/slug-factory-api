<template>
  <div>
<!--    <h1>Input group {{errors.email}}</h1>-->

    <MoleculeFormInput v-for="input in inputs"
       :key="input.elementId"
       :text="input.text"
       :element-id="input.elementId"
       :type="input.type"
        :errors="errors[input.elementId]"
       @input="formInput"
       class="mb-7"
    />
  </div>
</template>

<script setup lang="ts">
  import { PropType } from "@vue/runtime-core";
  import {FormInput} from "~/types/FormInput";

  defineProps({
    inputs: {
      type: Array as PropType<FormInput[]>,
      required: true
    },
    errors: Object
  })

  const emit = defineEmits(['input', 'update:modelValue'])


  function formInput(value, element)
  {
    // console.log('inputGroup', value, element)
    emit('input', value, element)
  }


</script>
