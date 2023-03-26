<template>
  <div>
    <OrganismInputGroup class="mb-5" :inputs="inputs" />
    <AtomBaseButton :text="buttonText" class="w-full" />
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
  inputs: Array as PropType<Array<IFormInput>>,
  buttonText: String
})
</script>
