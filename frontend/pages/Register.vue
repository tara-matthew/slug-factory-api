<template>
  <TemplateWelcome :header-content=loginData.headerContent :button-text="loginData.buttonText" :inputs="loginData.inputs" />
</template>
<script setup lang="ts">
import { ref } from 'vue';

const loginData = ref({
  headerContent: 'Welcome to Slug Factory',
  buttonText: 'Become a member and get printing',
  inputs: [
    {
      text: "Your name",
      elementId: "test"
    },
    {
      text: "Email",
      elementId: "test"
    },
    {
      text: "Choose a username",
      elementId: "test"
    },
    {
      text: "Password",
      elementId: "test"
    },
    {
      text: "Confirm your password",
      elementId: "test"
    }
  ],
})
</script>
