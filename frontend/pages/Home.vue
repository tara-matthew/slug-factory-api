<template>
    <div v-if="!loading" class="flex flex-col justify-center">
        <div class="px-60 pt-28">
            <AtomBaseTitle tag="h1" content="Recently added" class="text-center mb-8" />

            <OrganismBaseGrid :columns="5">
                <MoleculeBaseCard v-for="print in prints.slice(0,5)">
                    <template #image>
                        <img src="https://fastly.picsum.photos/id/404/200/300.jpg?hmac=1i6ra6DJN9kJ9AQVfSf3VD1w08FkegBgXuz9lNDk1OM" alt="" class="w-full h-48 object-cover">
                    </template>
                    <template #title>
                        <AtomBaseTitle tag="h2" :content="print.title" />
                    </template>
                    <template #content>
                        <p>{{ print.description }}</p>
                    </template>
                    <template #footer>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Go somewhere
                        </button>
                    </template>
                </MoleculeBaseCard>
            </OrganismBaseGrid>
        </div>

        <div class="w-full flex justify-around">
            <div class="w-[45%] mt-10 px-16 py-10">
                <AtomBaseTitle tag="h1" content="Most popular" class="text-center mb-8" />
                <OrganismBaseGrid :columns="3">
                    <MoleculeBaseCard v-for="print in prints.slice(0,6)">
                        <template #image>
                            <img src="https://fastly.picsum.photos/id/404/200/300.jpg?hmac=1i6ra6DJN9kJ9AQVfSf3VD1w08FkegBgXuz9lNDk1OM" alt="" class="w-full h-48 object-cover">
                        </template>
                        <template #title>
                            <AtomBaseTitle tag="h2" :content="print.title" />
                        </template>
                        <template #content>
                            <p>{{ print.description }}</p>
                        </template>
                        <template #footer>
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Go somewhere
                            </button>
                        </template>
                    </MoleculeBaseCard>
                </OrganismBaseGrid>
            </div>

            <div class="w-[45%] mt-10 px-16 py-10">
                <AtomBaseTitle tag="h1" content="Recently viewed" class="text-center mb-8" />
                <OrganismBaseGrid :columns="3">
                    <MoleculeBaseCard v-for="print in prints.slice(0,6)">
                        <template #image>
                            <img src="https://fastly.picsum.photos/id/404/200/300.jpg?hmac=1i6ra6DJN9kJ9AQVfSf3VD1w08FkegBgXuz9lNDk1OM" alt="" class="w-full h-48 object-cover">
                        </template>
                        <template #title>
                            <AtomBaseTitle tag="h2" :content="print.title" />
                        </template>
                        <template #content>
                            <p>{{ print.description }}</p>
                        </template>
                        <template #footer>
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Go somewhere
                            </button>
                        </template>
                    </MoleculeBaseCard>
                </OrganismBaseGrid>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
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
        console.log(prints);
        // TODO limit to 5 and order correctly
    });
});

// TODO shuffle at the top in nav
</script>
