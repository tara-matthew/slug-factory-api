<template>
  <div class="w-1/2 m-auto min-h-screen flex flex-col items-center mt-7">
    <div class="w-1/2">
<!--      <h1>{{errors.email}}</h1>-->
<!--      <h1>{{errors.name}}</h1>-->

    <AtomBaseTitle tag="h1" :content="headerContent" class="text-center mb-4"/>
      <OrganismForm @button-clicked=buttonClicked @form-submit="formSubmit" :errors="errors" :inputs="inputs" :button-text="buttonText" />
    </div>
  </div>
</template>

<script setup lang="ts">
import { PropType } from "@vue/runtime-core";
import {FormInput} from "~/types/FormInput";

defineProps({
  headerContent: String,
  inputs: Array as PropType<FormInput[]>, // use the interface
  buttonText: String,
  errors: Object
})

const emit = defineEmits(['button-clicked', 'form-submit', 'form-input']);

function buttonClicked()
{
  console.log('form clicked');
  emit('button-clicked');
}

function formInput(value, element)
{
  // console.log('welcome', value, element);
  emit('form-input', value, element)

}

function formSubmit(event): void
{
  // console.log('form submit', event.target);
  emit('form-submit', event);
}

</script>
