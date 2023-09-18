<template>
    <div v-if="!loading" class="flex flex-col justify-center">
        <div class="px-60 pt-8">
            <AtomBaseTitle tag="h1" content="Recently added" class="text-center mb-8" />

            <OrganismBaseGrid :columns="5">
                <NuxtLink v-for="print in prints.slice(0,5)" :key="print.id" :to="`/prints/${print.id}`">
                    <MoleculeBaseCard>
                        <template #image>
                            <img :src="print.images[0].url" alt="" class="w-full h-48 object-cover">
                        </template>
                        <template #title>
                            <AtomBaseTitle tag="h2" :content="print.title" />
                        </template>
                        <template #content>
                            <p>{{ print.description }}</p>
                        </template>
                        <template #footer>
                            <AtomBaseButton component-type="NuxtLink" text="View print" :to="`/prints/${print.id}`" />
                        </template>
                    </MoleculeBaseCard>
                </NuxtLink>
            </OrganismBaseGrid>
        </div>

        <div class="w-full flex justify-around">
            <div class="w-[45%] mt-10 px-16 py-10">
                <AtomBaseTitle tag="h1" content="Most popular" class="text-center mb-8" />
                <OrganismBaseGrid :columns="3">
                    <MoleculeBaseCard v-for="print in prints.slice(0,6)" :key="print.id">
                        <template #image>
                            <img :src="print.images[0].url" alt="" class="w-full h-48 object-cover">
                        </template>
                        <template #title>
                            <AtomBaseTitle tag="h2" :content="print.title" />
                        </template>
                        <template #content>
                            <p>{{ print.description }}</p>
                        </template>
                        <template #footer>
                            <AtomBaseButton component-type="NuxtLink" text="View print" to="/register" />
                        </template>
                    </MoleculeBaseCard>
                </OrganismBaseGrid>
            </div>

            <div class="w-[45%] mt-10 px-16 py-10">
                <AtomBaseTitle tag="h1" content="Recently viewed" class="text-center mb-8" />
                <OrganismBaseGrid :columns="3">
                    <MoleculeBaseCard v-for="print in prints.slice(0,6)" :key="print.id">
                        <template #image>
                            <img :src="print.images[0].url" alt="" class="w-full h-48 object-cover">
                        </template>
                        <template #title>
                            <AtomBaseTitle tag="h2" :content="print.title" />
                        </template>
                        <template #content>
                            <p>{{ print.description }}</p>
                        </template>
                        <template #footer>
                            <AtomBaseButton component-type="NuxtLink" text="View print" to="/register" />
                        </template>
                    </MoleculeBaseCard>
                </OrganismBaseGrid>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Ref } from "vue";
import { NuxtLink } from "#components";

const { $apiFetch } = useNuxtApp();

const prints: Ref = ref([]);
const loading = ref(true);

definePageMeta({
    middleware: ["auth"]
});

interface IImage {
    id: string,
    printed_design_id: string,
    url: string,
    is_cover_image: boolean,
    user_id ?: number
}

interface IResponseBody {
    id: string, // todo check whether string or number
    title: string
    description: string,
    user_id: number,
    images: IImage
}

interface IResponse {
    data: IResponseBody[]
}

async function retrieve (): Promise<IResponse> {
    // https://github.com/nuxt/nuxt/issues/18570
    // eslint-disable-next-line @typescript-eslint/ban-ts-comment
    // @ts-ignore
    return await ($apiFetch)("/api/prints", {
        headers: {
            Accept: "application/json"
        },
        method: "GET"
    });
}

onMounted(async () => {
    const response = await retrieve();
    prints.value = response.data;
    loading.value = false;
    // TODO limit to 5 and order correctly
});

// TODO shuffle at the top in nav
// TODO use nuxt-img
</script>
