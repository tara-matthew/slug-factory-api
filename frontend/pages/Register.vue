<template>
    <TemplateWelcome :errors="errors" :header-content="loginData.headerContent" :button-text="loginData.buttonText" :inputs="loginData.inputs" @form-submit="register" />
</template>
<script setup lang="ts">
import { ref } from "vue";
import { FetchError } from "ofetch";
import { $Fetch } from "nitropack";
import { LoginData } from "~/types/LoginData";

const errors = ref([]);
const { $apiFetch } = useNuxtApp();

definePageMeta({
    middleware: ["guest"]
});

function csrf () {
    return ($apiFetch as $Fetch)("/sanctum/csrf-cookie");
}

async function register (event: { target: HTMLFormElement | undefined; }) {
    await csrf();

    const formData = new FormData(event.target);
    try {
        // eslint-disable-next-line @typescript-eslint/ban-types
        await ($apiFetch as Function)("/auth/register", {
            headers: {
                Accept: "application/json",
                "X-XSRF-TOKEN": useCookie("XSRF-TOKEN").value
            },
            method: "POST",
            body: formData
        });

        await ($apiFetch as $Fetch)("/auth/login", {
            method: "POST",
            body: formData
        });

        // eslint-disable-next-line @typescript-eslint/ban-types
        const user = await ($apiFetch as Function)("/api/user");
        const { setUser } = useAuth();
        setUser(user);

        window.location.pathname = "/home";
    } catch (error) {
        // console.dir(error);
        // console.log("Error Message!", error.message);
        errors.value = (error as FetchError).data.errors;
    }
}

const loginData = ref<LoginData>({
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
