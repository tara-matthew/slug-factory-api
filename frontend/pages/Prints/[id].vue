<template>
    <div v-if="!loading">
        <h1 @click="addToFavourites" class="text-right">
            Add to favourites
        </h1>

        <div class="flex items-center px-32">
            <div style="flex:.75;">
                <AtomBaseTitle tag="h1" :content="print.title" class="text-center mb-4" />

                <nuxt-img :src="print.images[0].url" sizes="sm:100vw md:50vw lg:800px" style="width:100%;"/>
            </div>
            <div style="flex:1;" class="px-6">
                <p class="text-2xl">
                    {{ print.description }}
                </p>
            </div>
        </div>

<!--        <div class="pl-20 w-2/5">-->
<!--            <AtomBaseTitle tag="h1" :content="print.title" class="text-center mb-4" />-->
<!--        </div>-->
<!--        <div class="pl-20 w-2/5">-->
<!--            <div>-->
<!--                <nuxt-img :src="print.images[0].url" sizes="sm:100vw md:50vw lg:800px" style="width:100%"/>-->
<!--            </div>-->
<!--        </div>-->
<!--            <div class="pl-20 w-3/5 inline-block">-->

<!--            <p class="text-2xl">-->
<!--                {{ print.description }}-->
<!--            </p>-->

<!--        </div>-->
<!--        <div class="flex">-->
<!--            <div class="px-40 pt-28 flex flex-col w-3/5">-->
<!--                <AtomBaseTitle tag="h1" :content="print.title" class="text-center mb-4" />-->
<!--                <nuxt-img :src="print.images[0].url" sizes="sm:100vw md:50vw lg:800px" />-->
<!--            </div>-->
<!--            <div class="w-2/5 pt-28 pr-40 flex items-center">-->
<!--                <p class="text-2xl">-->
<!--                    {{ print.description }}-->
<!--                </p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="mx-32 mt-36">-->
<!--            <p class="text-2xl">-->
<!--                {{ print.description }}-->
<!--            </p>-->
<!--        </div>-->
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
