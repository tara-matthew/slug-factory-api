<template>
    <div v-if="!loading">
        <h1>Print ID: {{ $route.params.id }}</h1>
        <p>{{ print.images[0].url }}</p>
        <nuxt-img :src="print.images[0].url" sizes="sm:100vw md:50vw lg:400px" />
    </div>
</template>

<script setup lang="ts">
const { $apiFetch } = useNuxtApp();

const print = ref([]);
const loading = ref(true);
const route = useRoute();

onMounted(async () => {
    await ($apiFetch as Function)(`/api/prints/${route.params.id}`, {
        headers: {
            Accept: "application/json"
        },
        method: "GET"
    }).then((response) => {
        print.value = response.data;
        loading.value = false;
    });
});
</script>
