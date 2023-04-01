<template>
  <form action="#" @submit.prevent="submitForm">
    <OrganismInputGroup class="mb-5" :inputs="inputs" @input="formInput"/>
    <AtomBaseButton @button-clicked=buttonClicked :text="buttonText" class="w-full" />
  </form>
</template>

<script setup lang="ts">
import {FormInput} from "~/types/FormInput";
import {PropType} from "@vue/runtime-core";

defineProps({
  inputs: Array as PropType<FormInput[]>,
  buttonText: String
})

const emit = defineEmits(['button-clicked', 'form-submit','input']);

function test(varOne)
{
  console.log('here', varOne)
}

function submitForm(event): void
{
  console.log('submit', event);
  emit('form-submit', event);
}

function formInput(value: any, element)
{
  // console.log('form', value, element);
  emit('input', value, element)
}

function buttonClicked()
{
  console.log('clicked');
  emit('button-clicked');
}
</script>
