<template>
  <div>
    <MoleculeFormInput v-for="input in inputs"
       :key="input.elementId"
       :text="input.text"
       :element-id="input.elementId"
       :type="input.type"
       @input="formInput"
       v-on:update:modelValue="test"
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
    }
  })

  function test(varOne)
  {
    console.log('here', varOne);
  }

  const emit = defineEmits(['input', 'update:modelValue'])


  function formInput(value, element)
  {
    // console.log('inputGroup', value, element)
    emit('input', value, element)
  }


</script>
