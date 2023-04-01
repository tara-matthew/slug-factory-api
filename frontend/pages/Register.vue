<template>
    <TemplateWelcome :errors="errors" :header-content="loginData.headerContent" :button-text="loginData.buttonText" :inputs="loginData.inputs" @form-submit="register" />
</template>
<script setup lang="ts">
import { ref } from "vue";

const errors = ref([]);
const { $apiFetch } = useNuxtApp();

function csrf () {
    return $apiFetch("/sanctum/csrf-cookie");
}

async function register (event: { target: HTMLFormElement | undefined; }) {
    await csrf();

    const formData = new FormData(event.target);
    console.log(useCookie("XSRF-TOKEN").value);
    try {
        await $apiFetch("/auth/register", {
            headers: {
                Accept: "application/json",
                "X-XSRF-TOKEN": useCookie("XSRF-TOKEN").value
            },
            method: "POST",
            body: formData
        });

        window.location.pathname = "/home";
    } catch (error: any) {
        console.log(typeof error);
        errors.value = error.data.errors;
    }
    // }
}

const loginData = ref({
    headerContent: "Welcome to Slug Factory",
    buttonText: "Become a member and get printing",
    inputs: [
        {
            text: "Your name",
            elementId: "name"
        },
        {
            text: "Email",
            elementId: "email"
        },
        {
            text: "Choose a username",
            elementId: "username"
        },
        {
            text: "Password",
            type: "password",
            elementId: "password"
        },
        {
            text: "Confirm your password",
            type: "password",
            elementId: "password_confirmation"
        }
    ]
});
</script>
