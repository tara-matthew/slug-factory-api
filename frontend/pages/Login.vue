<template>
  <TemplateWelcome header-content="loginData.headerContent" :button-text="loginData.buttonText" :inputs="loginData.inputs" />
</template>
<script setup lang="ts">
import { ref } from "vue";
import { LoginData } from "~/types/LoginData";

const loginData = ref<LoginData>({
    headerContent: "Welcome back!",
    buttonText: "Login",
    inputs: [
        {
            text: "Username",
            elementId: "Test"
        },
        {
            text: "Password",
            elementId: "Test"
        }
    ]
});
</script>
