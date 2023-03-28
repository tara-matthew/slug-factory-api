<template>
  <div>
    <OrganismInputGroup class="mb-5" :inputs="inputs" />
    <AtomBaseButton :text="buttonText" class="w-full" />
  </div>
</template>

<script setup lang="ts">
import {FormInput} from "~/types/FormInput";
import {PropType} from "@vue/runtime-core";

defineProps({
  inputs: Array as PropType<FormInput[]>,
  buttonText: String
})
</script>
