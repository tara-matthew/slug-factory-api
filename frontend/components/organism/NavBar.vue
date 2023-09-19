<template>
    <nav class="p-5 flex justify-between bg-purple-500 items-center">
        <!-- TODO change to a logo atom at some point -->
        <div>
            <NuxtLink class="text-white font-bold" to="/home" style="font-size: 18px;">
                Slug Factory
            </NuxtLink>
        </div>
        <ul class="flex items-center">
            <li v-for="(link, index) in links" :key="index">
                <NuxtLink :to="link.path" class="pr-8 text-white">
                    {{ link.title }}
                </NuxtLink>
            </li>
            <li v-if="isLoggedIn">
                <NuxtLink to="#" class="pl-7 text-white font-bold" @click.prevent="logout">
                    Log Out
                </NuxtLink>
            </li>
            <li v-if="isLoggedIn">
                <NuxtLink to="#" class="pl-7 text-white font-bold">
                    {{ getUser()?.name }}
                </NuxtLink>
            </li>
        </ul>
    </nav>
</template>

<script setup lang="ts">
const { $apiFetch } = useNuxtApp();
const { removeUser, isLoggedIn, getUser } = useAuth();

const props = defineProps({
    links: {
        type: Object,
        required: true
    }
});

onMounted(() => {
    // console.log(props)
})

async function logout () {
    try {
        await $apiFetch("/auth/logout", {
            method: "POST"
        });
    } catch (err) {
        console.log(err.data);
    } finally {
        removeUser();
        window.location.pathname = "/login";
    }
}
</script>
