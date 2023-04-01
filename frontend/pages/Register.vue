<template>
  <TemplateWelcome @form-submit="register" @form-input=formInput :header-content=loginData.headerContent :button-text="loginData.buttonText" :inputs="loginData.inputs" />
</template>
<script setup lang="ts">
import { ref } from 'vue';

const input = ref('')
const name = ref('dawd')
const email = ref('dqwd@gmail.com')
const password = ref('Password123!')
const passwordConfirm = ref('Password123!')
const { $apiFetch } = useNuxtApp()
const { $listen } = useNuxtApp()

// $listen('input-updated', (value) => {
//   console.log('Input changed', value)
//   const element = value.target.id;
//   console.log(element);
//   name.value = value;
//   console.log(name.value);
// })

function formInput(value, element) {
  console.log('register', value, element)
  // ref(element).value = value;
  // const refValue = ref(element).value;
  // console.log(ref(refValue), name)
}

async function csrf()
{
  await $apiFetch('/sanctum/csrf-cookie');

}

async function register(event)
{
  const token = await csrf();
  console.log(token);
  const formData = new FormData(event.target);
  const { data: count } = await $apiFetch('/auth/register', {
    method: 'POST',
    body: formData
  })
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
      type: "password",
      elementId: "password"
    },
    {
      text: "Confirm your password",
      type: "password",
      elementId: "password_confirmation"
    }
  ],
})
</script>
