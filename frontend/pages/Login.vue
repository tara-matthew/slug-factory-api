<template>
  <TemplateWelcome :header-content=loginData.headerContent :button-text="loginData.buttonText" :inputs="loginData.inputs" />
</template>
<script setup lang="ts">
import { ref } from 'vue';

const loginData = ref({
  headerContent: 'Welcome back to Slug Factory',
  buttonText: 'Login',
  inputs: [
    {
      text: "Username",
      elementId: "Test"
    },
    {
      text: "Password",
      elementId: "Test"
    }
  ],
})
</script>
