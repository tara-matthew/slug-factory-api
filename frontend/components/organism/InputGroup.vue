<template>
  <div>
    <MoleculeFormInput v-for="input in inputs"
       :key="input.elementId"
       :text="input.text"
       :element-id="input.elementId"
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
</script>
