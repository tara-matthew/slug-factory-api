<template>
    <nav class="p-5 flex justify-between bg-purple-500 items-center">
        <!-- TODO change to a logo atom at some point -->
        <div>
            <NuxtLink class="text-white font-bold" to="/home" style="font-size: 18px;">Slug Factory</NuxtLink>
        </div>
        <ul class="flex items-center">
            <li v-for="(link, index) in links" :key="index">
                <NuxtLink :to="link.path" class="pr-8 text-white">{{ link.title }}</NuxtLink>
            </li>
            <!-- TODO this will be dynamic for the logged in user -->
            <li>
                <NuxtLink to="#" class="pl-7 text-white font-bold" style="font-size: 18px;">Tara</NuxtLink>
            </li>
        </ul>
    </nav>
</template>

<script setup lang="ts">
defineProps({
    links: {
        type: Object,
        required: true
    }
});
</script>
