<template>
  <div class="w-1/2 m-auto min-h-screen flex flex-col items-center mt-7">
    <div class="w-1/2">

    <AtomBaseTitle tag="h1" :content="headerContent" class="text-center mb-4"/>
      <OrganismForm :inputs="inputs" :button-text="buttonText" />
    </div>
  </div>
</template>

<script setup lang="ts">
import { PropType } from "@vue/runtime-core";
import {FormInput} from "~/types/FormInput";

defineProps({
  headerContent: String,
  inputs: Array as PropType<FormInput[]>, // use the interface
  buttonText: String
})

</script>
