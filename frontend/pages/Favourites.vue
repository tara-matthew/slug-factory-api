<template>
    <h1>Favourites</h1>
    <ul>
        <li v-for="print in prints">
            {{ print.title }}
        </li>
    </ul>
</template>

<script setup lang="ts">
import { $Fetch } from "nitropack";
import { FetchError } from "ofetch";
import { Ref } from "vue";

const { $apiFetch } = useNuxtApp();
const prints: Ref = ref([]);

definePageMeta({
    middleware: ["auth"]
});

async function retrieve() {
    try {
        return (await $apiFetch as $Fetch)("/api/printed-designs/favourite", {
            method: "GET"
        });
    } catch (error: unknown) {
        // if (error instanceof FetchError && error.response?.status === 401) {
        //     removeUser();
        // } else {
        //     console.log(error);
        // }
    }
}

onMounted(async () => {
    const response = await retrieve();
    console.log(response);
    prints.value = response.data;
})
</script>
