<template>
  <form @submit.prevent="submitForm">
    <OrganismInputGroup class="mb-5" :inputs="inputs" :errors="errors" @input="formInput" />
    <AtomBaseButton :text="buttonText" class="w-full" @button-clicked="buttonClicked" />
  </form>
</template>

<script setup lang="ts">
import { PropType } from "vue";
import { FormInput } from "~/types/FormInput";

defineProps({
    inputs: Array as PropType<FormInput[]>,
    buttonText: String,
    errors: Object
});

const emit = defineEmits(["button-clicked", "form-submit", "input"]);

function test (varOne) {
    console.log("here", varOne);
}

function submitForm (event): void {
    console.log("submit", event);
    emit("form-submit", event);
}

function formInput (value: any, element) {
    // console.log('form', value, element);
    emit("input", value, element);
}

function buttonClicked () {
    console.log("clicked");
    emit("button-clicked");
}
</script>
