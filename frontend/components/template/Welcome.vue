<template>
  <div class="w-1/2 m-auto">
    <AtomBaseTitle tag="h1" :content="headerContent" class="text-center"/>
    <OrganismForm :inputs="inputs" :button-text="buttonText" />
  </div>
</template>

<script setup lang="ts">
import { PropType } from "@vue/runtime-core";

interface IFormInput {
  text: string,
  elementId: string
}

const props = defineProps({
  headerContent: String,
  inputs: Array as PropType<IFormInput[]>, // use the interface
  buttonText: String
})

</script>
