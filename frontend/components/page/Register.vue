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
      text: "Email",
    },
    {
      text: "Choose a username"
    },
    {
      text: "Password"
    }
  ],
})
</script>
