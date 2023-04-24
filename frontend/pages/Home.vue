<template>
    <ul v-if="!loading">
        <li v-for="print of prints">
            Title: {{ print.title }}
            Description: {{ print.description }}
        </li>
    </ul>
</template>

<script setup lang="ts">
const { $apiFetch } = useNuxtApp();

const prints = ref([]);
const loading = ref(true);

onMounted(async () => {
    await ($apiFetch as Function)("/api/prints", {
        headers: {
            Accept: "application/json",
        },
        method: "GET"
    }).then((response) => {
        prints.value = response.data;
        loading.value = false;
        console.log(prints);
    });
});
</script>
