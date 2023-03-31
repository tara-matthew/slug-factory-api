<template>
  <TemplateWelcome @form-submit="register" :header-content=loginData.headerContent :button-text="loginData.buttonText" :inputs="loginData.inputs" />
</template>
<script setup lang="ts">
import { ref } from 'vue';
import Cookies from 'js-cookie';

const name = ref('')
const email = ref('')
const password = ref('')
const passwordConfirm = ref('')
const { $apiFetch } = useNuxtApp()

async function csrf()
{
  await $apiFetch('/sanctum/csrf-cookie');
  console.log(Cookies.get('XSRF-TOKEN'))
}

async function register()
{
  await csrf();
  // console.log(Cookies.get('XSRF-TOKEN'))
  // const { data: count } = await useFetch('http://localhost/auth/register', {
  //   method: 'POST',
  //   headers: {
  //     'Content-Type': 'application/json',
  //     'X-XSRF-TOKEN': Cookies.get('XSRF-TOKEN')
  //   },
  //   body: {
  //
  //   }
  // })
}

const loginData = ref({
  headerContent: 'Welcome to Slug Factory',
  buttonText: 'Become a member and get printing',
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
      elementId: "password"
    },
    {
      text: "Confirm your password",
      elementId: "password_confirmation"
    }
  ],
})
</script>
