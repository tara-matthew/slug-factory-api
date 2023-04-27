<template>
    <div v-if="!loading" class="flex flex-col justify-center">
        <div class="px-60 pt-28">
            <AtomBaseTitle tag="h1" content="Recently added" class="text-center mb-8" />

            <OrganismBaseGrid :columns="5">
                <NuxtLink v-for="print in prints.slice(0,5)" :to="`/prints/${print.id}`">
                    <MoleculeBaseCard>
                        <template #image>
                            <img :src="print.images[0].url" alt="" class="w-full h-48 object-fill">
                        </template>
                        <template #title>
                            <AtomBaseTitle tag="h2" :content="print.title" />
                        </template>
                        <template #content>
                            <p>{{ print.description }}</p>
                        </template>
                        <template #footer>
                            <AtomBaseButton component-type="NuxtLink" text="Go somewhere" :to="`/prints/${print.id}`" />
                        </template>
                    </MoleculeBaseCard>
                </NuxtLink>
            </OrganismBaseGrid>
        </div>

        <div class="w-full flex justify-around">
            <div class="w-[45%] mt-10 px-16 py-10">
                <AtomBaseTitle tag="h1" content="Most popular" class="text-center mb-8" />
                <OrganismBaseGrid :columns="3">
                    <MoleculeBaseCard v-for="print in prints.slice(0,6)">
                        <template #image>
                            <img :src="print.images[0].url" alt="" class="w-full h-48 object-fill">
                        </template>
                        <template #title>
                            <AtomBaseTitle tag="h2" :content="print.title" />
                        </template>
                        <template #content>
                            <p>{{ print.description }}</p>
                        </template>
                        <template #footer>
                            <AtomBaseButton component-type="NuxtLink" text="Go somewhere" to="/register" />
                        </template>
                    </MoleculeBaseCard>
                </OrganismBaseGrid>
            </div>

            <div class="w-[45%] mt-10 px-16 py-10">
                <AtomBaseTitle tag="h1" content="Recently viewed" class="text-center mb-8" />
                <OrganismBaseGrid :columns="3">
                    <MoleculeBaseCard v-for="print in prints.slice(0,6)">
                        <template #image>
                            <img :src="print.images[0].url" alt="" class="w-full h-48 object-fill">
                        </template>
                        <template #title>
                            <AtomBaseTitle tag="h2" :content="print.title" />
                        </template>
                        <template #content>
                            <p>{{ print.description }}</p>
                        </template>
                        <template #footer>
                            <AtomBaseButton component-type="NuxtLink" text="Go somewhere" to="/register" />
                        </template>
                    </MoleculeBaseCard>
                </OrganismBaseGrid>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { NuxtLink } from "#components";
const { $apiFetch } = useNuxtApp();

const prints = ref([]);
const loading = ref(true);

onMounted(async () => {
    await ($apiFetch as Function)("/api/prints", {
        headers: {
            Accept: "application/json"
        },
        method: "GET"
    }).then((response) => {
        prints.value = response.data;
        loading.value = false;
        console.log(prints.value[0].images[0]);
        // TODO limit to 5 and order correctly
    });
});

// TODO shuffle at the top in nav
// TODO use nuxt-img
</script>
