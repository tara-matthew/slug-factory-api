<template>
    <div v-if="!loading">
        <h1 @click="addToFavourites">
            Add to favourites
        </h1>
        <div class="flex justify-center">
            <div class="px-60 pt-28 flex flex-col w-3/5">
                <AtomBaseTitle tag="h1" :content="print.title" class="text-center mb-4" />
                <nuxt-img :src="print.images[0].url" sizes="sm:100vw md:50vw lg:800px" />
            </div>
        </div>
        <div class="mx-32 mt-36">
            <p class="text-2xl">
                {{ print.description }}
            </p>
        </div>
    </div>
</template>

<script setup lang="ts">
// TODO tabs with settings, filament used, story, source

const { $apiFetch } = useNuxtApp();

const print = ref([]);
const loading = ref(true);
const route = useRoute();
const { getUser } = useAuth();

onMounted(async () => {
    await ($apiFetch)(`/api/prints/${route.params.id}`, {
        // headers: {
        //     Accept: "application/json",
        // },
        method: "GET"
    }).then((response) => {
        print.value = response.data;
        loading.value = false;
    });
});

async function addToFavourites () {
    try {
        await ($apiFetch)(`/api/users/${getUser()?.id}/favourite-printed-designs/${route.params.id}`, {
            method: "PATCH"
        });
    } catch (error) {
        console.log(error);
    }
    // console.log(favourite);
}
</script>
