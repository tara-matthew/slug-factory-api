<template>
  <div>
    <MoleculeFormInput v-for="input in inputs"
       :text="input.text"
       :element-id="input.elementId"
       class="mb-3"
    />
  </div>
</template>

<script setup lang="ts">
  import { PropType } from "@vue/runtime-core";

  interface IFormInput {
    text: string,
    elementId: string
  }
  //
  const props = defineProps({
    // inputs: Array
    inputs: Array as PropType<Array<IFormInput>>
  })
</script>
